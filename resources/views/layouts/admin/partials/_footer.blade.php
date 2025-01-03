<div class="footer">
    <div class="row justify-content-between align-items-center">
        <div class="col">
            <p class="font-size-sm mb-0">
                @php($shop_name=\App\Models\BusinessSetting::where('key','shop_name')->first()->value)
                @php($footer_text=\App\Models\BusinessSetting::where('key','footer_text')->first()->value)
                &copy; {{ $shop_name }}. <span class="d-none d-sm-inline-block">{{ $footer_text }}</span>
            </p>
        </div>
        <div class="col-auto">
            <div class="d-flex justify-content-end">
                <ul class="list-inline list-separator">
                    <li class="list-inline-item">
                        <a class="list-separator-link" href="{{route('admin.business-settings.shop-setup')}}">{{\App\Utils\translate('settings')}}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="list-separator-link" href="{{route('admin.settings')}}">{{\App\Utils\translate('profile')}}</a>
                    </li>
                    <li class="list-inline-item">
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                               href="{{route('admin.dashboard')}}">
                                <i class="tio-home-outlined"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
