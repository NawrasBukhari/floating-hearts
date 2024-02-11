<?php

namespace NawrasBukhari\FloatingHearts\Http\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\JsValidation\Facades\JsValidator;
use Botble\Setting\Facades\Setting;
use Illuminate\Contracts\View\View;
use NawrasBukhari\FloatingHearts\Http\Requests\FloatingHeartsRequest;

class FloatingHeartsController extends BaseController
{
    public function edit(): View
    {
        PageTitle::setTitle(trans('plugins/floating-hearts::floating-hearts.name'));

        Assets::addScripts(['jquery-validation', 'form-validation']);

        $jsValidation = JsValidator::formRequest(FloatingHeartsRequest::class);

        return view('plugins/floating-hearts::settings', compact('jsValidation'));
    }

    public function update(FloatingHeartsRequest $request): BaseHttpResponse
    {
        foreach ($request->validated() as $key => $value) {
            Setting::set(sprintf('floating-hearts.%s', $key), $value);
        }

        Setting::save();

        return BaseHttpResponse::make()
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}
