
<div id="sidebarMain" class="d-none">
    <aside class="aside-back js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container text-capitalize">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between nav-brand-back side-logo" style="border-bottom: 1px solid #ffffff;">
                    @php($shop_logo=\App\Models\BusinessSetting::where(['key'=>'shop_logo'])->first()->value)
                    @php ($shop_name = \App\Models\BusinessSetting::where(['key'=>'shop_name'])->first()->value)
                    <a class="navbar-brand d-flex align-items-center" href="{{route('admin.dashboard')}}" aria-label="{{\App\Utils\translate('Front')}}">
                        <img class="navbar-brand-logo"
                             src="{{onErrorImage($shop_logo, asset('storage/shop').'/' . $shop_logo,asset('assets/admin/img/ecartify.png') ,'shop/')}}"
                             alt="{{\App\Utils\translate('logo')}}">
                        <span class="navbar-brand-text ml-4" style="color: #ffffff">{{ $shop_name }}</span>
                    </a>
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg" style="color: #ffffff"></i>
                    </button>
                </div>

                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <li class="nav-item">
                            <small
                                class="nav-subtitle">{{\App\Utils\translate('dashboard_section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.dashboard')}}" title="{{\App\Utils\translate('dashboards')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                                    <path d="M25,2C12.318,2,2,12.317,2,25s10.318,23,23,23s23-10.317,23-23S37.682,2,25,2z M32.113,10.589l1.075-1.791 c0.284-0.474,0.897-0.627,1.372-0.343c0.474,0.284,0.627,0.898,0.343,1.372l-1.075,1.791c-0.188,0.313-0.519,0.485-0.858,0.485 c-0.175,0-0.353-0.046-0.514-0.143C31.982,11.677,31.829,11.063,32.113,10.589z M24,6.895c0-0.553,0.448-1,1-1s1,0.447,1,1v2.06 c0,0.553-0.448,1-1,1s-1-0.447-1-1V6.895z M8.561,15.335c0.284-0.475,0.898-0.628,1.372-0.343l1.791,1.074 c0.474,0.284,0.627,0.898,0.343,1.372c-0.188,0.313-0.519,0.485-0.858,0.485c-0.175,0-0.353-0.046-0.513-0.143l-1.791-1.074 C8.43,16.423,8.276,15.809,8.561,15.335z M6,24.895c0-0.553,0.448-1,1-1h2.06c0.552,0,1,0.447,1,1s-0.448,1-1,1H7 C6.448,25.895,6,25.447,6,24.895z M11.724,33.722l-1.791,1.075c-0.161,0.097-0.338,0.143-0.514,0.143 c-0.34,0-0.671-0.173-0.858-0.485c-0.284-0.474-0.131-1.088,0.343-1.372l1.791-1.075c0.473-0.284,1.088-0.131,1.372,0.343 C12.351,32.823,12.197,33.438,11.724,33.722z M17.544,11.961c-0.161,0.097-0.338,0.143-0.514,0.143c-0.34,0-0.671-0.173-0.858-0.485 l-1.075-1.791c-0.284-0.474-0.131-1.088,0.343-1.372c0.474-0.283,1.088-0.131,1.372,0.343l1.075,1.791 C18.171,11.063,18.018,11.677,17.544,11.961z M26.85,27.373C26.345,27.763,25.712,28,25,28c-1.7,0-3-1.3-3-3 c0-1.351,0.827-2.437,2.016-2.831l-0.004-0.007l17.307-6.67L26.856,27.384L26.85,27.373z M41.439,34.454 c-0.188,0.313-0.519,0.485-0.858,0.485c-0.175,0-0.353-0.046-0.514-0.143l-1.791-1.075c-0.474-0.284-0.627-0.898-0.343-1.372 c0.284-0.474,0.898-0.628,1.372-0.343l1.791,1.075C41.57,33.366,41.724,33.98,41.439,34.454z M43,25.895h-2.06c-0.552,0-1-0.447-1-1 s0.448-1,1-1H43c0.552,0,1,0.447,1,1S43.552,25.895,43,25.895z" />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">
                                    {{\App\Utils\translate('dashboard')}}
                                </span>
                            </a>
                        </li>
                        @if (\App\Utils\Helpers::module_permission_check('pos_section'))
                            <li class="nav-item">
                                <small
                                    class="nav-subtitle">{{\App\Utils\translate('orders')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            @php($orders = \App\Models\Order::get()->count())
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.pos.orders')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                                        <path d="M39.9 13c0 0-.1 0-.1 0-.5.1-.8.5-.8 1v19.2c0 .4.2.7.5.9.3.2.7.2 1 0 .3-.2.5-.5.5-.9V14c0-.3-.1-.6-.3-.8C40.5 13.1 40.2 13 39.9 13zM35 4H12c-1.1 0-2 .9-2 2v29c0 1.1.9 2 2 2h23c1.1 0 2-.9 2-2V6C37 4.9 36.1 4 35 4zM15 10c0-.6.4-1 1-1h15c.6 0 1 .4 1 1v5c0 .6-.4 1-1 1H16c-.6 0-1-.4-1-1V10zM19 31c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V31zM19 26c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V26zM19 21c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V21zM26 31c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V31zM26 26c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V26zM26 21c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V21zM33 31c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V31zM33 26c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V26zM33 21c0 .6-.4 1-1 1h-3c-.6 0-1-.4-1-1v-1c0-.6.4-1 1-1h3c.6 0 1 .4 1 1V21z" />
                                    </svg>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">
                                        {{\App\Utils\translate('orders')}}
                                    </span>
                                </a>
                            </li>
                        @endif
                        <?php
                        $modules = ['category_section', 'brand_section', 'unit_section', 'product_section', 'stock_section'];
                        ?>
                        @if (collect($modules)->contains(fn($module) => \App\Utils\Helpers::module_permission_check($module)))
                        <li class="nav-item">
                            <small
                                class="nav-subtitle">{{\App\Utils\translate('product_section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('category_section'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/category*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" style="width: 20px;" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                                    <path d="M6 4C4.84 4 4 4.84 4 6L4 22C4 23.16 4.84 24 6 24L22 24C23.16 24 24 23.16 24 22L24 6C24 4.84 23.16 4 22 4L6 4 z M 28 4C27.477778 4 26.94539 4.1913289 26.568359 4.5683594C26.191329 4.9453899 26 5.4777778 26 6L26 22C26 22.522222 26.191329 23.05461 26.568359 23.431641C26.94539 23.808671 27.477778 24 28 24L44 24C44.522222 24 45.05461 23.808671 45.431641 23.431641C45.808671 23.05461 46 22.522222 46 22L46 6C46 5.4777778 45.808671 4.9453899 45.431641 4.5683594C45.05461 4.1913289 44.522222 4 44 4L28 4 z M 28 6L44 6L44 22L28 22L28 6 z M 32.980469 25.990234 A 1.0001 1.0001 0 0 0 32.869141 26L28 26C27.477778 26 26.94539 26.191329 26.568359 26.568359C26.191329 26.94539 26 27.477778 26 28L26 32.847656 A 1.0001 1.0001 0 0 0 26 33.179688L26 38.847656 A 1.0001 1.0001 0 0 0 26 39.179688L26 44C26 44.522222 26.191329 45.05461 26.568359 45.431641C26.94539 45.808671 27.477778 46 28 46L32.824219 46 A 1.0001 1.0001 0 0 0 33.152344 46L38.824219 46 A 1.0001 1.0001 0 0 0 39.152344 46L44 46C44.522222 46 45.05461 45.808671 45.431641 45.431641C45.808671 45.05461 46 44.522222 46 44L46 39.126953 A 1.0001 1.0001 0 0 0 46 38.851562L46 33.126953 A 1.0001 1.0001 0 0 0 46 32.851562L46 28C46 27.477778 45.808671 26.94539 45.431641 26.568359C45.05461 26.191329 44.522222 26 44 26L39.146484 26 A 1.0001 1.0001 0 0 0 38.980469 25.990234 A 1.0001 1.0001 0 0 0 38.869141 26L33.146484 26 A 1.0001 1.0001 0 0 0 32.980469 25.990234 z M 6 26C4.84 26 4 26.84 4 28L4 44C4 45.16 4.84 46 6 46L22 46C23.16 46 24 45.16 24 44L24 28C24 26.84 23.16 26 22 26L6 26 z M 28 28L30.585938 28L28 30.585938L28 28 z M 33.414062 28L36.585938 28L28 36.585938L28 33.414062L33.414062 28 z M 39.414062 28L42.585938 28L28 42.585938L28 39.414062L39.414062 28 z M 44 29.414062L44 32.585938L32.585938 44L29.414062 44L44 29.414062 z M 10 30C11.1 30 12 30.9 12 32C12 33.1 11.1 34 10 34C8.9 34 8 33.1 8 32C8 30.9 8.9 30 10 30 z M 18 30C19.1 30 20 30.9 20 32C20 33.1 19.1 34 18 34C16.9 34 16 33.1 16 32C16 30.9 16.9 30 18 30 z M 44 35.414062L44 38.585938L38.585938 44L35.414062 44L44 35.414062 z M 10 38C11.1 38 12 38.9 12 40C12 41.1 11.1 42 10 42C8.9 42 8 41.1 8 40C8 38.9 8.9 38 10 38 z M 18 38C19.1 38 20 38.9 20 40C20 41.1 19.1 42 18 42C16.9 42 16 41.1 16 40C16 38.9 16.9 38 18 38 z M 44 41.414062L44 44L41.414062 44L44 41.414062 z" />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">{{\App\Utils\translate('category')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub {{Request::is('admin/category*')?'d-block':''}}">
                                <li class="nav-item {{Request::is('admin/category/add')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.category.add')}}"
                                       title="{{\App\Utils\translate('add_new_category')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('category')}}</span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/category/add-sub-category')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.category.add-sub-category')}}"
                                       title="{{\App\Utils\translate('add_new_sub_category')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('sub_category')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('brand_section'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/brand*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.brand.add')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                                    <path d="M24.9375 0.03125C24.554688 0.046875 24.183594 0.191406 23.9375 0.46875C23.859375 0.449219 23.796875 0.4375 23.71875 0.4375C23.058594 0.4375 22.691406 0.847656 22.5625 1.21875C22.453125 1.539063 22.394531 2.179688 23.25 2.84375C23.074219 2.980469 22.902344 3.101563 22.6875 3.28125L22.59375 3.375C22.378906 3.546875 22.21875 3.722656 22.125 3.90625C22.078125 3.894531 22.019531 3.882813 21.96875 3.875C21.25 3.792969 20.558594 4.402344 20.40625 4.96875C20.359375 5.140625 20.328125 5.429688 20.3125 5.71875C20.042969 5.546875 19.851563 5.398438 19.78125 5.28125C19.648438 5.023438 19.453125 4.773438 19.21875 4.5L19.125 4.375C18.886719 4.0625 18.582031 3.75 17.875 3.6875C17.160156 3.621094 16.375 4.125 16.15625 4.71875C15.992188 5.171875 15.988281 6.222656 16 6.40625C16.007813 6.535156 16.050781 6.773438 16.21875 7L33.78125 7C33.945313 6.773438 33.992188 6.53125 34 6.40625C34.011719 6.246094 34.011719 5.179688 33.84375 4.71875C33.621094 4.125 32.816406 3.628906 32.125 3.6875C31.414063 3.75 31.113281 4.0625 30.875 4.375L30.78125 4.5C30.539063 4.785156 30.34375 5.03125 30.21875 5.28125C30.148438 5.398438 29.957031 5.546875 29.6875 5.71875C29.671875 5.433594 29.640625 5.175781 29.59375 5C29.453125 4.464844 28.851563 3.875 28.15625 3.875C28.117188 3.875 28.070313 3.871094 28.03125 3.875C27.753906 3.910156 27.535156 4.015625 27.375 4.125C27.03125 3.8125 26.589844 3.582031 26.09375 3.46875C26.21875 3.355469 26.355469 3.242188 26.46875 3.125C26.578125 3.015625 26.660156 2.914063 26.75 2.84375C27.609375 2.183594 27.546875 1.539063 27.4375 1.21875C27.308594 0.847656 26.941406 0.4375 26.28125 0.4375C26.203125 0.4375 26.136719 0.449219 26.0625 0.46875C26.042969 0.449219 26.019531 0.425781 26 0.40625C25.71875 0.125 25.320313 0.015625 24.9375 0.03125 Z M 4.8125 9C4.054688 9 3.4375 9.359375 3.15625 9.96875C2.511719 11.367188 3.925781 13.226563 4.5625 13.96875C4.566406 13.976563 4.589844 13.996094 4.59375 14L12 14L12 12L14 12L14 14L17 14L17 12L19 12L19 14L22 14L22 12L24 12L24 14L27 14L27 12L29 12L29 14L32 14L32 12L34 12L34 14L37 14L37 12L39 12L39 14L45.40625 14C45.410156 13.996094 45.433594 13.976563 45.4375 13.96875C46.074219 13.222656 47.488281 11.363281 46.84375 9.96875C46.5625 9.359375 45.945313 9 45.1875 9 Z M 1.8125 16C1.054688 16 0.4375 16.359375 0.15625 16.96875C-0.488281 18.367188 0.925781 20.226563 1.5625 20.96875C1.988281 21.464844 2.480469 21.949219 3 22.375L3 24C3 24.550781 3.449219 25 4 25L47 25C47.554688 25 48 24.550781 48 24L48 21.46875C48.148438 21.316406 48.296875 21.160156 48.4375 21C49.070313 20.253906 50.488281 18.363281 49.84375 16.96875C49.5625 16.359375 48.945313 16 48.1875 16 Z M 7 20L9 20L9 23L7 23 Z M 12 20L14 20L14 23L12 23 Z M 17 20L19 20L19 23L17 23 Z M 22 20L24 20L24 23L22 23 Z M 27 20L29 20L29 23L27 23 Z M 32 20L34 20L34 23L32 23 Z M 37 20L39 20L39 23L37 23 Z M 42 20L44 20L44 23L42 23 Z M 3 27L3 50L9 50L9 27 Z M 16 27L16 50L22 50L22 27 Z M 29 27L29 50L35 50L35 27 Z M 42 27L42 50L48 50L48 27Z" />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">
                                    {{\App\Utils\translate('brand')}}
                                </span>
                            </a>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('unit_section'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/unit*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.unit.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" >
                                    <path d="M40 3C39.719 3 39.453672 3.1182188 39.263672 3.3242188C39.149672 3.4492188 36.839687 5.9980312 36.179688 8.7070312C37.294688 9.1860312 38.727047 9.9782813 39.998047 11.238281C41.272047 9.9842813 42.708266 9.1928906 43.822266 8.7128906C43.164266 6.0028906 40.851328 3.4492187 40.736328 3.3242188C40.547328 3.1182188 40.281 3 40 3 z M 46.410156 10.001953C46.312344 9.9950469 46.211781 10.002641 46.113281 10.025391C45.977281 10.057391 43.054 10.770891 41 13.087891L41 17.367188C43.115 15.726187 45.330203 15.155125 45.658203 15.078125C46.404203 14.905125 47.1705 15.026719 47.8125 15.386719C48.2115 13.514719 47.92225 11.500875 47.15625 10.421875C46.97925 10.173625 46.703594 10.022672 46.410156 10.001953 z M 33.585938 10.003906C33.293438 10.025797 33.01925 10.175125 32.84375 10.421875C32.07775 11.499875 31.789453 13.514766 32.189453 15.384766C32.826453 15.026766 33.585172 14.904219 34.326172 15.074219C34.655172 15.149219 36.879 15.711234 39 17.365234L39 13.095703C36.946 10.754703 34.015859 10.056391 33.880859 10.025391C33.782359 10.003391 33.683437 9.9966094 33.585938 10.003906 z M 46.410156 17.001953C46.312344 16.995219 46.213734 17.002141 46.115234 17.025391C45.979234 17.057391 43.055953 17.770891 41.001953 20.087891L41.001953 24.367188C43.115953 22.725187 45.329203 22.155125 45.658203 22.078125C46.404203 21.905125 47.1705 22.026719 47.8125 22.386719C48.2125 20.515719 47.924203 18.499875 47.158203 17.421875C46.981203 17.172875 46.703594 17.022156 46.410156 17.001953 z M 33.585938 17.003906C33.293438 17.025656 33.01925 17.175125 32.84375 17.421875C32.07775 18.499875 31.789453 20.514766 32.189453 22.384766C32.825453 22.026766 33.585172 21.904219 34.326172 22.074219C34.655172 22.149219 36.879 22.711234 39 24.365234L39 20.095703C36.946 17.754703 34.015859 17.056391 33.880859 17.025391C33.782359 17.003141 33.683437 16.996656 33.585938 17.003906 z M 24.525391 22.001953C23.760391 21.985953 22.702594 22.178609 21.683594 22.599609C26.532594 25.573609 27.918281 31.472156 27.988281 31.785156C28.108281 32.324156 27.769469 32.855563 27.230469 32.976562C27.159469 32.992562 27.085672 33 27.013672 33C26.556672 33 26.144063 32.68375 26.039062 32.21875C25.963062 31.88075 24.088219 23.940906 16.949219 23.003906C15.663219 23.012906 14.417188 23.376766 13.367188 23.884766C17.036188 26.659766 18.852172 31.385437 18.951172 31.648438C19.144172 32.165438 18.883187 32.740547 18.367188 32.935547C18.250188 32.979547 18.132625 33 18.015625 33C17.610625 33 17.230125 32.751563 17.078125 32.351562C17.055125 32.290563 15.155687 27.363547 11.554688 25.060547C11.530688 25.081547 11.501516 25.102047 11.478516 25.123047C9.3635156 25.881047 2 29.36 2 37C2 39.068 2.7336406 40.849969 4.1816406 42.292969C8.3746406 46.477969 18.008969 47 25.042969 47L25.380859 47C28.588859 46.992 33.412625 46.734688 37.015625 46.179688L37.015625 42.914062C35.240625 42.699062 32.825781 41.972156 31.300781 39.535156C29.861781 37.236156 29.627703 33.835453 30.595703 31.439453L30.246094 29.802734C29.829094 27.850734 30.010641 25.804672 30.681641 24.263672C28.514641 22.353672 26.385391 22.039953 24.525391 22.001953 z M 33.585938 24.001953C33.293438 24.023703 33.01925 24.173172 32.84375 24.419922C32.07775 25.497922 31.789453 27.513766 32.189453 29.384766C32.818453 29.030766 33.570547 28.908313 34.310547 29.070312C34.353547 29.080313 34.445797 29.102578 34.591797 29.142578C36.365797 29.629578 37.886953 30.662297 39.001953 32.029297L39.001953 27.09375C36.947953 24.75275 34.017812 24.054437 33.882812 24.023438C33.784312 24.001188 33.683437 23.994703 33.585938 24.001953 z M 46.410156 24.001953C46.312344 23.995094 46.211781 24.002391 46.113281 24.025391C45.977281 24.057391 43.054 24.769938 41 27.085938L41 32.044922C42.069 30.730922 43.509547 29.718984 45.185547 29.208984C45.459547 29.125984 45.631016 29.084172 45.666016 29.076172C46.413016 28.901172 47.1745 29.022813 47.8125 29.382812C48.2115 27.512812 47.92225 25.497922 47.15625 24.419922C46.97925 24.171672 46.703594 24.022531 46.410156 24.001953 z M 46.410156 31.001953C46.312344 30.995047 46.213734 31.002641 46.115234 31.025391C46.089234 31.031391 45.964625 31.062047 45.765625 31.123047C42.917625 31.989047 41.001953 34.658766 41.001953 37.634766L41 41C42.014 41 45.323859 41.164609 47.005859 38.474609C48.390859 36.263609 48.228203 32.927875 47.158203 31.421875C46.981203 31.173625 46.703594 31.022672 46.410156 31.001953 z M 41 41L39 41L39 46C39 46.552 39.448 47 40 47C40.552 47 41 46.552 41 46L41 41 z M 39 41L39.001953 37.636719C39.001953 34.590719 36.993641 31.876313 34.056641 31.070312C33.959641 31.043312 33.899813 31.029391 33.882812 31.025391C33.488813 30.939391 33.07775 31.091875 32.84375 31.421875C31.77475 32.927875 31.613094 36.263609 32.996094 38.474609C34.677094 41.163609 37.985 41 39 41 z"  />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">
                                    {{\App\Utils\translate('unit')}}
                                </span>
                            </a>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('product_section'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/product*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                                    <path d="M5 4C4.449219 4 4 4.449219 4 5L4 15C4 15.550781 4.449219 16 5 16L45 16C45.554688 16 46 15.550781 46 15L46 5C46 4.449219 45.554688 4 45 4 Z M 5 18C4.449219 18 4 18.449219 4 19L4 45C4 45.554688 4.449219 46 5 46L29 46C29.554688 46 30 45.554688 30 45L30 19C30 18.449219 29.554688 18 29 18 Z M 33 18C32.445313 18 32 18.449219 32 19L32 25C32 25.550781 32.445313 26 33 26L45 26C45.554688 26 46 25.550781 46 25L46 19C46 18.449219 45.554688 18 45 18 Z M 33 28C32.445313 28 32 28.445313 32 29L32 35C32 35.554688 32.445313 36 33 36L45 36C45.554688 36 46 35.554688 46 35L46 29C46 28.445313 45.554688 28 45 28 Z M 33 38C32.445313 38 32 38.445313 32 39L32 45C32 45.554688 32.445313 46 33 46L45 46C45.554688 46 46 45.554688 46 45L46 39C46 38.445313 45.554688 38 45 38Z" />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">{{\App\Utils\translate('product')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub {{Request::is('admin/product*')?'d-block':''}}">
                                <li class="nav-item {{Request::is('admin/product/add')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.product.add')}}"
                                       title="{{\App\Utils\translate('add_new_product')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('add_new')}}</span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/product/list')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.product.list')}}"
                                       title="{{\App\Utils\translate('list_of_products')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('list')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/product/bulk-import')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.product.bulk-import')}}"
                                       title="{{\App\Utils\translate('bulk_import')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('bulk_import')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/product/bulk-export')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.product.bulk-export')}}"
                                       title="{{\App\Utils\translate('bulk_export')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('bulk_export')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('stock_section'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/stock*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.stock.stock-limit')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                                    <path d="M25 3C24.89775 3 24.795766 3.015375 24.697266 3.046875L3.6972656 10.046875C3.2822656 10.178875 3 10.564 3 11L3 46C3 46.552 3.448 47 4 47L41 47L41.173828 47L46 47C46.552 47 47 46.552 47 46L47 11C47 10.564 46.717734 10.178875 46.302734 10.046875L25.302734 3.046875C25.204234 3.015375 25.10225 3 25 3 z M 10 18L40 18L40 45L36 45L36 36C36 35.448 35.552 35 35 35L27 35C26.448 35 26 35.448 26 36L26 45L24 45L24 36C24 35.448 23.552 35 23 35L15 35C14.448 35 14 35.448 14 36L14 45L10 45L10 18 z M 20.832031 23C20.372031 23 20 23.372984 20 23.833984L20 32.167969C20 32.627969 20.372984 33 20.833984 33L29.167969 33C29.627969 33 30 32.627016 30 32.166016L30 23.832031C30 23.372031 29.627016 23 29.166016 23L20.832031 23 z" />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">
                                    {{\App\Utils\translate('stock_limit_products')}}
                                </span>
                            </a>
                        </li>
                        @endif
                        <?php
                        $modules = ['coupon_section', 'account_section'];
                        ?>
                        @if (collect($modules)->contains(fn($module) => \App\Utils\Helpers::module_permission_check($module)))
                        <li class="nav-item">
                            <small
                                class="nav-subtitle">{{\App\Utils\translate('business_section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('coupon_section'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/coupon*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.coupon.add-new')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" >
                                    <path d="M4.0625 5C3.039063 5 1.988281 5.417969 1.1875 6.21875C-0.414063 7.820313 -0.414063 10.304688 1.1875 11.90625C1.585938 12.308594 2.789063 13.507813 3.1875 13.90625C4.085938 14.804688 5.394531 15.199219 6.59375 15L9.1875 17.59375L12.59375 14.21875L10 11.625C10.199219 10.425781 9.804688 9.117188 8.90625 8.21875L6.90625 6.21875C6.105469 5.417969 5.085938 5 4.0625 5 Z M 27.09375 5C25.492188 5 24.007813 5.613281 22.90625 6.8125L6.59375 23C5.394531 22.800781 4.085938 23.195313 3.1875 24.09375L1.1875 26.09375C-0.414063 27.695313 -0.414063 30.179688 1.1875 31.78125C2.789063 33.382813 5.304688 33.382813 6.90625 31.78125C7.304688 31.382813 8.507813 30.179688 8.90625 29.78125C9.804688 28.882813 10.199219 27.574219 10 26.375L31.40625 5 Z M 3.84375 7.53125C4.308594 7.457031 4.796875 7.609375 5.15625 8C5.347656 8.207031 6.464844 9.324219 6.65625 9.53125C7.136719 10.050781 7.085938 11.042969 6.5625 11.625C5.941406 12.203125 5.042969 12.152344 4.46875 11.53125C4.277344 11.324219 3.160156 10.238281 2.96875 10.03125C2.394531 9.410156 2.441406 8.511719 3.0625 7.9375C3.296875 7.722656 3.5625 7.578125 3.84375 7.53125 Z M 23 16L21 18L26 18L26 16 Z M 28 16L28 18L32 18L32 16 Z M 34 16L34 18L38 18L38 16 Z M 40 16L40 18L44 18L44 16 Z M 46 16L46 18L48 18L48 20L50 20L50 16 Z M 14 17.90625C14.605469 17.90625 15.09375 18.394531 15.09375 19C15.09375 19.605469 14.605469 20.09375 14 20.09375C13.394531 20.09375 12.90625 19.605469 12.90625 19C12.90625 18.394531 13.394531 17.90625 14 17.90625 Z M 18.8125 20.40625L15.46875 23.75L21.90625 30.1875C23.007813 31.386719 24.492188 32 26.09375 32L30.40625 32 Z M 48 22L48 26L50 26L50 22 Z M 5.6875 25.90625C6.0625 25.90625 6.449219 26.042969 6.75 26.34375C7.25 26.945313 7.25 27.9375 6.75 28.4375C6.550781 28.636719 5.386719 29.707031 5.1875 29.90625C4.585938 30.507813 3.695313 30.507813 3.09375 29.90625C2.492188 29.304688 2.492188 28.414063 3.09375 27.8125C3.292969 27.613281 4.457031 26.542969 4.65625 26.34375C4.957031 26.042969 5.3125 25.90625 5.6875 25.90625 Z M 12 27L10 31L10 32L12 32 Z M 48 28L48 32L50 32L50 28 Z M 10 34L10 38L12 38L12 34 Z M 48 34L48 38L50 38L50 34 Z M 10 40L10 44L14 44L14 42L12 42L12 40 Z M 48 40L48 42L46 42L46 44L50 44L50 40 Z M 16 42L16 44L20 44L20 42 Z M 22 42L22 44L26 44L26 42 Z M 28 42L28 44L32 44L32 42 Z M 34 42L34 44L38 44L38 42 Z M 40 42L40 44L44 44L44 42Z"  />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">{{\App\Utils\translate('coupons')}}</span>
                            </a>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('account_section'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/account*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" >
                                    <path d="M19.875 4.40625C16.195313 4.472656 13.507813 5.570313 11.875 7.71875C9.941406 10.265625 9.589844 14.144531 10.8125 19.21875C10.363281 19.769531 10.023438 20.605469 10.15625 21.71875C10.421875 23.921875 11.277344 24.828125 12 25.1875C12.34375 26.917969 13.296875 28.863281 14.21875 29.78125L14.21875 30.25C14.226563 31.265625 14.222656 32.144531 14.125 33.28125C13.511719 34.6875 11.476563 35.511719 9.125 36.4375C5.21875 37.976563 0.363281 39.871094 0 45.9375L-0.0625 47L40.0625 47L40 45.9375C39.976563 45.515625 39.910156 45.132813 39.84375 44.75C39.824219 44.652344 39.800781 44.5625 39.78125 44.46875C39.71875 44.179688 39.675781 43.894531 39.59375 43.625C39.570313 43.546875 39.523438 43.484375 39.5 43.40625C39.402344 43.121094 39.308594 42.824219 39.1875 42.5625C39.167969 42.519531 39.144531 42.480469 39.125 42.4375C38.980469 42.136719 38.828125 41.863281 38.65625 41.59375C36.871094 38.796875 33.660156 37.527344 30.90625 36.4375C28.566406 35.511719 26.519531 34.6875 25.90625 33.28125C25.808594 32.148438 25.835938 31.292969 25.84375 30.28125L25.84375 29.78125C26.742188 28.863281 27.664063 26.925781 28 25.1875C28.703125 24.824219 29.582031 23.914063 29.84375 21.71875C29.976563 20.628906 29.65625 19.800781 29.21875 19.25C29.800781 17.269531 30.988281 12.113281 28.9375 8.8125C28.488281 8.089844 27.90625 7.535156 27.21875 7.09375C26.90625 6.894531 26.578125 6.707031 26.21875 6.5625C25.855469 6.421875 25.472656 6.300781 25.0625 6.21875C24.117188 5.027344 22.304688 4.40625 19.875 4.40625 Z M 32.90625 5.40625C31.488281 5.433594 30.257813 5.664063 29.1875 6.0625C29.75 6.550781 30.25 7.128906 30.65625 7.78125C32.8125 11.253906 32.140625 15.988281 31.375 18.96875C31.800781 19.867188 31.941406 20.890625 31.8125 21.96875C31.535156 24.292969 30.679688 25.613281 29.78125 26.375C29.371094 27.890625 28.648438 29.449219 27.84375 30.53125C27.835938 31.289063 27.828125 31.929688 27.875 32.6875C28.417969 33.300781 30.242188 34.015625 31.625 34.5625C34.6875 35.773438 38.964844 37.480469 40.9375 41.59375L50.0625 41.59375L50 40.53125C49.6875 35.320313 45.539063 33.683594 42.21875 32.375C40.375 31.648438 38.632813 30.953125 38.125 29.84375C38.050781 28.910156 38.054688 28.183594 38.0625 27.34375L38.0625 27C38.859375 26.167969 39.59375 24.527344 39.875 23.15625C40.492188 22.808594 41.214844 22.003906 41.4375 20.15625C41.546875 19.234375 41.304688 18.523438 40.9375 18.03125C41.441406 16.292969 42.390625 11.972656 40.65625 9.1875C39.917969 8 38.804688 7.269531 37.34375 6.96875C36.507813 5.953125 34.972656 5.40625 32.90625 5.40625Z"  />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">
                                    {{\App\Utils\translate('account_management')}}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub {{Request::is('admin/account*')?'d-block':''}}">
                                <li class="nav-item {{Request::is('admin/account/add')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.account.add')}}"
                                       title="{{\App\Utils\translate('add_new_account')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('add_new_account')}}</span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/account/list')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.account.list')}}"
                                       title="{{\App\Utils\translate('account_list')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('accounts')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/account/add-expense')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.account.add-expense')}}"
                                       title="{{\App\Utils\translate('add_new_expense')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('new_expense')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/account/add-income')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.account.add-income')}}"
                                       title="{{\App\Utils\translate('add_new_income')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('new_income')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/account/add-transfer')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.account.add-transfer')}}"
                                       title="{{\App\Utils\translate('add_new_transfer')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('new_transfer')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/account/list-transaction')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.account.list-transaction')}}"
                                       title="{{\App\Utils\translate('list_of_transaction')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('transaction_list')}}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        <?php
                        $modules = ['employee_role_section', 'employee_section'];
                        ?>
                        @if (collect($modules)->contains(fn($module) => \App\Utils\Helpers::module_permission_check($module)))
                        <li class="nav-item">
                            <small class="nav-subtitle">{{\App\Utils\translate('Employee Section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/custom-role*') || Request::is('admin/employee*') ? 'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                                    <path d="M14 0 A 6 6 0 0 0 8 6 A 6 6 0 0 0 14 12 A 6 6 0 0 0 20 6 A 6 6 0 0 0 14 0 z M 36.099609 0 A 6 6 0 0 0 30.099609 6 A 6 6 0 0 0 36.099609 12 A 6 6 0 0 0 42.099609 6 A 6 6 0 0 0 36.099609 0 z M 10.099609 13C7.0761065 13 4.5682366 15.211732 4.0898438 18.101562C3.1172566 18.313765 2.2385491 18.847388 1.5429688 19.542969C0.63583386 20.450104 1.4802974e-16 21.666667 0 23C0 24.970809 1.3489904 26.903825 4 28.013672L4 32.800781C4 33.972781 5.0709687 35 6.2929688 35L7.9785156 35L7.9785156 47.699219C7.9785156 48.946219 9.0284844 50 10.271484 50L17.730469 50C18.973469 50 20.023437 48.946219 20.023438 47.699219L20.023438 35L21.707031 35C22.949031 35 24 33.946219 24 32.699219L24 26.359375C24.442191 26.219625 24.859382 26.10156 25.316406 25.949219C25.553609 25.869952 25.766953 25.812036 26 25.736328L26 32.699219C26 33.946219 27.053781 35 28.300781 35L30 35L30 47.699219C30 48.946219 31.053781 50 32.300781 50L39.800781 50C41.047781 50 42.099609 48.946219 42.099609 47.699219L42.099609 35L43.800781 35C45.026781 35 46.099609 33.972781 46.099609 32.800781L46.099609 31.496094C47.178402 31.283369 48.091098 30.732302 48.736328 29.996094C49.575175 29.03897 50 27.804647 50 26.570312C50 25.331286 49.436861 24.090083 48.367188 23.146484C47.297514 22.202886 45.753557 21.52654 43.712891 21.181641C39.631557 20.491842 33.50672 21.102327 24.683594 24.050781C15.781435 27.018168 9.9188298 27.414481 6.4511719 26.699219C2.9835139 25.983956 2 24.381341 2 23C2 22.333333 2.3641661 21.549896 2.9570312 20.957031C3.2671012 20.646961 3.6296429 20.403859 4 20.238281L4 23.824219C6.236 25.041219 12 26.000438 24 22.273438L24 19.099609C24 15.735609 21.264391 13 17.900391 13L10.099609 13 z M 32.128906 13C28.749906 13 26 15.735609 26 19.099609L26 21.634766C37.077 18.120766 43.007609 18.622172 46.099609 19.826172L46.099609 19.099609C46.099609 15.735609 43.351656 13 39.972656 13L32.128906 13 z M 46.099609 24.027344C46.468481 24.223131 46.796851 24.429375 47.042969 24.646484C47.745483 25.266199 48 25.903339 48 26.570312C48 27.33598 47.721577 28.119608 47.232422 28.677734C46.934429 29.017745 46.559358 29.271668 46.099609 29.427734L46.099609 24.027344 z" />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">{{\App\Utils\translate('Employee')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub {{Request::is('admin/custom-role*') || Request::is('admin/employee*') ?'d-block':''}}">
                                @if (\App\Utils\Helpers::module_permission_check('employee_role_section'))
                                <li class="nav-item {{Request::is('admin/custom-role*')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.custom-role.create')}}"
                                       title="{{\App\Utils\translate('Employee_Role_Setup')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('Employee Role')}}</span>
                                    </a>
                                </li>
                                @endif
                                @if (\App\Utils\Helpers::module_permission_check('employee_section'))
                                <li class="nav-item {{Request::is('admin/employee*')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.employee.add-new')}}"
                                       title="{{\App\Utils\translate('Employee_add')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('Add Employee')}}</span>
                                    </a>
                                </li>
                                    @endif
                            </ul>
                        </li>
                        @endif

                        <?php
                            $modules = ['departement_section', 'natureofleave_section','leave_request_section'];
                        ?>
                        @if (collect($modules)->contains(fn($module) => \App\Utils\Helpers::module_permission_check($module)))
                        <li class="nav-item">
                            <small class="nav-subtitle">{{\App\Utils\translate('HRM')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/departement*') || Request::is('admin/leave-request*') ? 'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M480.975 406.979C468.435 416.405 452.86 422 436 422s-32.435-5.595-44.975-15.021C372.795 420.661 361 442.452 361 467v45h135c8.284 0 15-6.716 15-15v-30c0-24.548-11.795-46.339-30.025-60.021zM300.975 406.979C288.435 416.405 272.86 422 256 422s-32.435-5.595-44.975-15.021C192.795 420.661 181 442.452 181 467v45h150v-45c0-24.548-11.795-46.339-30.025-60.021zM76 392c24.853 0 45-20.147 45-45 0-19.592-12.524-36.251-30-42.429V287c0-8.271 6.729-15 15-15h135v32.571c-17.476 6.179-30 22.837-30 42.429 0 24.853 20.147 45 45 45s45-20.147 45-45c0-19.592-12.524-36.251-30-42.429V272h135c8.271 0 15 6.729 15 15v17.571c-17.476 6.179-30 22.838-30 42.429 0 24.853 20.147 45 45 45s45-20.147 45-45c0-19.592-12.524-36.251-30-42.429V287c0-24.813-20.187-45-45-45H271v-32h45c8.284 0 15-6.716 15-15v-30c0-24.548-11.795-46.339-30.025-60.021C288.435 114.405 272.86 120 256 120s-32.435-5.595-44.975-15.021C192.795 118.661 181 140.452 181 165v30c0 8.284 6.716 15 15 15h45v32H106c-24.813 0-45 20.187-45 45v17.571C43.524 310.749 31 327.408 31 347c0 24.853 20.147 45 45 45zM120.975 406.979C108.435 416.405 92.86 422 76 422s-32.435-5.595-44.975-15.021C12.795 420.661 1 442.452 1 467v30c0 8.284 6.716 15 15 15h135v-45c0-24.548-11.795-46.339-30.025-60.021z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path><circle cx="256" cy="45" r="45" fill="#ffffff" opacity="1" data-original="#000000" class=""></circle></g></svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">{{\App\Utils\translate('HRM')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub {{Request::is('admin/departement*') || Request::is('admin/natureofleave*') || Request::is('admin/leave-request*') ?'d-block':''}}">
                                @if (\App\Utils\Helpers::module_permission_check('departement_section'))
                                <li class="nav-item {{Request::is('admin/departement*')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.departement.index')}}"
                                       title="{{\App\Utils\translate('departement_list')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('department')}}</span>
                                    </a>
                                </li>
                                @endif
                                @if (\App\Utils\Helpers::module_permission_check('natureofleave_section'))
                                    <li class="nav-item {{Request::is('admin/natureofleave*')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.natureofleave.index')}}"
                                        title="{{\App\Utils\translate('nature_of_leave')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\Utils\translate('nature_of_leave')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if (\App\Utils\Helpers::module_permission_check('leave_request_section'))
                                    <li class="nav-item {{Request::is('admin/leave-request/create')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.leave-request.create')}}"
                                        title="{{\App\Utils\translate('Leave Request')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\Utils\translate('Leave Request')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if (\App\Utils\Helpers::module_permission_check('leave_request_section'))
                                    <li class="nav-item {{Request::is('admin/leave-request')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.leave-request.index')}}"
                                        title="{{\App\Utils\translate('Employee_add')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\Utils\translate('List Request')}}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('customer_section'))
                        <li class="nav-item">
                            <small
                                class="nav-subtitle">{{\App\Utils\translate('customer_section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/customer*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 25px;" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" >
                                    <path d="M18 2C15.243 2 13 4.243 13 7C13 9.757 15.243 12 18 12C18.406969 12 18.796774 11.93789 19.175781 11.845703L20.009766 13.619141C16.423894 15.696553 14 19.565951 14 24C14 25.144401 14.172095 26.247758 14.472656 27.296875L11.201172 28.308594C10.311042 26.924194 8.7646181 26 7 26C4.243 26 2 28.243 2 31C2 33.757 4.243 36 7 36C9.757 36 12 33.757 12 31C12 30.719865 11.972236 30.447396 11.927734 30.179688L15.189453 29.171875C16.716674 32.350673 19.595668 34.75134 23.083984 35.626953L22.785156 38.009766C20.12829 38.123627 18 40.315606 18 43C18 45.757 20.243 48 23 48C25.757 48 28 45.757 28 43C28 40.864925 26.649073 39.051479 24.761719 38.335938L25.060547 35.951172C25.371693 35.975467 25.682722 36 26 36C29.352187 36 32.383157 34.614232 34.5625 32.390625L38.587891 35.697266C38.224771 36.389688 38 37.165413 38 38C38 40.757 40.243 43 43 43C45.757 43 48 40.757 48 38C48 35.243 45.757 33 43 33C41.801309 33 40.715775 33.442534 39.853516 34.148438L35.837891 30.851562C37.196279 28.906888 38 26.546895 38 24C38 21.050949 36.925447 18.351312 35.154297 16.259766L38.248047 13.166016C39.038546 13.689985 39.982644 14 41 14C43.757 14 46 11.757 46 9C46 6.243 43.757 4 41 4C38.243 4 36 6.243 36 9C36 10.017356 36.310015 10.961454 36.833984 11.751953L33.740234 14.845703C31.648688 13.074553 28.949051 12 26 12C24.528241 12 23.124324 12.280626 21.820312 12.767578L20.982422 10.988281C22.199464 10.075427 23 8.6349711 23 7C23 4.243 20.757 2 18 2 z M 26 17C26.926 17 27.6845 17.252766 27.9375 17.759766C29.4685 17.951766 29.99 19.28 30 20.5C30.008 21.428 29.932 22.24 29.75 22.75C29.918 22.834 30.084 23.244 30 23.75C29.832 24.678 29.253 25 29 25C28.916 25.844 28.337 27.081 28 27.25L28 29C28.54 30.297 31.134797 30.287578 32.716797 31.392578C30.940797 33.006578 28.589 34 26 34C23.411 34 21.059203 33.006578 19.283203 31.392578C20.865203 30.287578 23.46 30.297 24 29L24 27.25C23.663 27.081 23.084 25.844 23 25C22.747 25 22.084 24.678 22 23.75C21.916 23.244 22.082 22.834 22.25 22.75C22.049 22.004 22.005 21.286 22 20.625C21.985 18.521 23.241 17 26 17 z"  />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">{{\App\Utils\translate('customer')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub {{Request::is('admin/customer*')?'d-block':''}}">
                                <li class="nav-item {{Request::is('admin/customer/add')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.customer.add')}}"
                                       title="{{\App\Utils\translate('add_new_customer')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('add_customer')}}</span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/customer/list')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.customer.list')}}"
                                       title="{{\App\Utils\translate('list_of_customers')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('customer_list')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('supplier_section'))
                        <li class="nav-item">
                            <small
                                class="nav-subtitle">{{\App\Utils\translate('supplier_section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/supplier*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" >
                                    <path d="M27 4C18.71 4 15.001953 9.273 15.001953 14.5C15.001953 15.619 15.240797 16.812688 15.716797 18.054688C15.320797 18.551687 15.013 19.251 15 20.125C14.998 20.25 14.998766 20.377766 15.009766 20.509766C15.267766 22.405766 16.024656 23.531047 16.847656 23.998047C17.176656 25.762047 18.117 27.558078 19 28.455078L19 32.326172C18.418 33.787172 16.370766 34.579141 14.009766 35.494141C10.144766 36.991141 5.3329531 38.854312 5.0019531 44.945312C4.9869531 45.219313 5.0844375 45.4885 5.2734375 45.6875C5.4624375 45.8865 5.726 46 6 46L26 46L26 49 A 1.0001 1.0001 0 0 0 27 50L49 50 A 1.0001 1.0001 0 0 0 50 49L50 28 A 1.0001 1.0001 0 0 0 49 27L31.994141 27C32.415079 26.211958 32.860175 25.159156 33.113281 24.056641C33.850281 23.730641 34.788094 22.865031 34.996094 20.582031C35.005094 20.469031 35 20.359 35 20.25C35.003 19.368 34.728547 18.633859 34.310547 18.130859C34.751547 17.153859 35.006 15.850094 35 14.496094C34.984 10.456094 33.001859 6.3823906 28.630859 6.0253906L27.894531 4.5527344C27.724531 4.2147344 27.379 4 27 4 z M 28 29L48 29L48 48L28 48L28 29 z M 34 31 A 1.0001 1.0001 0 1 0 34 33L42 33 A 1.0001 1.0001 0 1 0 42 31L34 31 z"  />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">{{\App\Utils\translate('supplier')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub {{Request::is('admin/supplier*')?'d-block':''}}">
                                <li class="nav-item {{Request::is('admin/supplier/add')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.supplier.add')}}"
                                       title="{{\App\Utils\translate('add_new_supplier')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('add_supplier')}}</span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/supplier/list')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.supplier.list')}}"
                                       title="{{\App\Utils\translate('list_of_suppliers')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('supplier_list')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if (\App\Utils\Helpers::module_permission_check('setting_section'))
                        <li class="nav-item">
                            <small class="nav-subtitle">{{\App\Utils\translate('shop_setting_section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/business-settings*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" >
                                    <path d="M47.16,21.221l-5.91-0.966c-0.346-1.186-0.819-2.326-1.411-3.405l3.45-4.917c0.279-0.397,0.231-0.938-0.112-1.282 l-3.889-3.887c-0.347-0.346-0.893-0.391-1.291-0.104l-4.843,3.481c-1.089-0.602-2.239-1.08-3.432-1.427l-1.031-5.886 C28.607,2.35,28.192,2,27.706,2h-5.5c-0.49,0-0.908,0.355-0.987,0.839l-0.956,5.854c-1.2,0.345-2.352,0.818-3.437,1.412l-4.83-3.45 c-0.399-0.285-0.942-0.239-1.289,0.106L6.82,10.648c-0.343,0.343-0.391,0.883-0.112,1.28l3.399,4.863 c-0.605,1.095-1.087,2.254-1.438,3.46l-5.831,0.971c-0.482,0.08-0.836,0.498-0.836,0.986v5.5c0,0.485,0.348,0.9,0.825,0.985 l5.831,1.034c0.349,1.203,0.831,2.362,1.438,3.46l-3.441,4.813c-0.284,0.397-0.239,0.942,0.106,1.289l3.888,3.891 c0.343,0.343,0.884,0.391,1.281,0.112l4.87-3.411c1.093,0.601,2.248,1.078,3.445,1.424l0.976,5.861C21.3,47.647,21.717,48,22.206,48 h5.5c0.485,0,0.9-0.348,0.984-0.825l1.045-5.89c1.199-0.353,2.348-0.833,3.43-1.435l4.905,3.441 c0.398,0.281,0.938,0.232,1.282-0.111l3.888-3.891c0.346-0.347,0.391-0.894,0.104-1.292l-3.498-4.857 c0.593-1.08,1.064-2.222,1.407-3.408l5.918-1.039c0.479-0.084,0.827-0.5,0.827-0.985v-5.5C47.999,21.718,47.644,21.3,47.16,21.221z M25,32c-3.866,0-7-3.134-7-7c0-3.866,3.134-7,7-7s7,3.134,7,7C32,28.866,28.866,32,25,32z"  />
                                </svg>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate ml-3">{{\App\Utils\translate('settings')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub {{Request::is('admin/business-settings*')?'d-block':''}}">
                                <li class="nav-item {{Request::is('admin/business-settings/shop-setup')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.business-settings.shop-setup')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{\App\Utils\translate('shop')}} {{\App\Utils\translate('setup')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item pt-8">

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>



