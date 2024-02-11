@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <form action="{{ route('floating-hearts.settings') }}" method="post">
        @method('PUT')
        @csrf

        <x-core-setting::section
            :title="trans('plugins/floating-hearts::floating-hearts.name')"
            :description="trans('plugins/floating-hearts::floating-hearts.description')"
        >
            <div class="mb-3">
                <x-core-setting::on-off
                    :label="trans('plugins/floating-hearts::floating-hearts.enable')"
                    name="enabled"
                    :value="setting('floating-hearts.enabled')"
                    data-bb-toggle="collapse"
                    data-bb-target=".floating-hearts-animation.settings"
                />
            </div>

            <div class="floating-hearts-animation.settings"
                 data-bb-value="1" @style(['display: none' => ! setting('floating-hearts.enabled')])>
                <x-core-setting::text-input
                    :label="trans('plugins/floating-hearts::floating-hearts.hearts_count')"
                    :value="setting('floating-hearts.hearts_count')"
                    name="hearts_count"
                />

                <x-core-setting::text-input
                    :label="trans('plugins/floating-hearts::floating-hearts.duration')"
                    :value="setting('floating-hearts.duration')"
                    name="duration"
                />
            </div>
        </x-core-setting::section>

        <div class="flexbox-annotated-section" style="border: none">
            <div class="flexbox-annotated-section-annotation">
                &nbsp;
            </div>
            <div class="flexbox-annotated-section-content">
                <x-core::button type="submit" color="primary">
                    {{ trans('core/setting::setting.save_settings') }}
                </x-core::button>
            </div>
        </div>
    </form>
@stop

@push('footer')
    {!! $jsValidation !!}
@endpush
