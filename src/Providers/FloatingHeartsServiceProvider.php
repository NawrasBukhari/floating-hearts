<?php

namespace NawrasBukhari\FloatingHearts\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Supports\ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Theme\Facades\Theme;

class FloatingHeartsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/floating-hearts')
            ->loadRoutes()
            ->loadAndPublishTranslations()
            ->publishAssets()
            ->loadAndPublishConfigurations('permissions')
            ->loadAndPublishViews();

        $this->app->booted(function () {
            $this->app['events']->listen(RouteMatched::class, function () {
                DashboardMenu::make()
                    ->registerItem([
                        'id' => 'plugins-floating-hearts',
                        'priority' => 99999,
                        'name' => 'plugins/floating-hearts::floating-hearts.name',
                        'icon' => version_compare('7.0.0', get_core_version(), '<=') ? 'ti ti-heart' : 'fa fa-heart',
                        'route' => 'floating-hearts.settings',
                    ]);

                if (setting('floating-hearts.enabled')) {
                    Theme::asset()
                        ->usePath(false)
                        ->add('floating-hearts-css', asset('vendor/core/plugins/floating-hearts/css/floating-hearts.css'));

                    Theme::asset()
                        ->container('footer')
                        ->usePath(false)
                        ->add('whatsapp-floating-button-js', asset('vendor/core/plugins/floating-hearts/js/floating-hearts.js'), ['floating-hearts-js']);

                    add_filter(THEME_FRONT_BODY, function (?string $data): string {
                        return $data . sprintf(
                                '<div id="floating-hearts" class="floating-hearts" data-hearts-count="%s" data-animation-duration="%s"></div>',
                                setting('floating-hearts.hearts_count'),
                                !str_contains(setting('floating-hearts.animation_duration'), 's')
                                    ? setting('floating-hearts.duration') . 's'
                                    : setting('floating-hearts.duration')
                            );
                    });
                }
            });
        });
    }
}
