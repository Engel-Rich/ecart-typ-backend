<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>{{\App\Utils\translate('Add to cart page')}}</title>
    @php($favIcon=\App\Models\BusinessSetting::where(['key'=>'fav_icon'])->first()->value)
    <link rel="shortcut icon" href="{{asset('storage/shop').'/' . $favIcon }}">

    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/google-fonts.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/theme.css?v=1.0">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/vendor/icon-set/style.css">
    @stack('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/custom.css"/>
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/pos.css"/>
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/toastr.css">

    <style>
        .text-decoration{
            text-decoration: line-through;
        }
    </style>
</head>
<body class="footer-offset">
    <div class="loader-wrapper" id="my-loader">
        <span class="loader"></span>
    </div>
    <div class="direction-toggle">
        <i class="tio-settings"></i>
        <span></span>
    </div>
    <header id="header"
            class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                @php($shop_logo=\App\Models\BusinessSetting::where('key','shop_logo')->first()->value)
                <a class="navbar-brand pt-0 pb-0" href="{{route('admin.dashboard')}}" aria-label="Front">
                    <img class="navbar-brand-logo w-i1"
                        src="{{onErrorImage($shop_logo,asset('storage/shop').'/' . $shop_logo,asset('assets/admin/img/ecartify.png') ,'shop/')}}"
                        alt="{{\App\Utils\translate('Logo')}}">
                </a>
            </div>
            <div class="navbar-nav-wrap-content-right">
                <ul class="navbar-nav align-items-center flex-row">
                    <li class="nav-item d-sm-inline-block">
                        <div class="hs-unfold">
                            <a id="short-cut" class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                data-toggle="modal" data-target="#short-cut-keys" title="{{\App\Utils\translate('short_cut_keys')}}">
                                <i class="tio-keyboard"></i>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item d-sm-inline-block">
                        <div class="hs-unfold">
                            <a data-toggle="tooltip" class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                href="{{route('admin.pos.orders')}}" target="_blank" title="{{\App\Utils\translate('order_list')}}">
                                <i class="tio-shopping-basket"></i>
                            </a>
                            <div class="tooltip bs-tooltip-top" role="tooltip">
                                <div class="arrow"></div>
                                <div class="tooltip-inner"></div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                                data-hs-unfold-options='{
                                        "target": "#accountNavbarDropdown",
                                        "type": "css-animation"
                                    }'>
                                <div class="avatar avatar-sm avatar-circle">
                                    <img class="avatar-img"
                                        src="{{auth('admin')->user()->image_fullpath}}"
                                        alt="{{\App\Utils\translate('Image')}}">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>
                            <div id="accountNavbarDropdown"
                                class="w-i2 hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                src="{{auth('admin')->user()->image_fullpath}}"
                                                alt="{{\App\Utils\translate('Owner image')}}">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5">{{auth('admin')->user()->f_name}}</span>
                                            <span class="card-text">{{auth('admin')->user()->email}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="logoutLink">
                                    <span class="text-truncate pr-2" title="Sign out">{{\App\Utils\translate('sign_out')}}</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <main id="content" role="main" class="main pointer-event">
        <section class="section-content pt-5">
            <div class="container-fluid">
                <div class="d-flex flex-wrap">
                    <div class="order--pos-left">
                        <div class="card h-100">
                            <h5 class="p-3 m-0 bg-light">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M512 0H379.871v99.097h16.516v264.258h-82.581v-99.097h-49.548V256c0-13.659-11.115-24.774-24.774-24.774h-8.597c-11.396-21.76-32.884-36.773-57.517-39.515l-8.209-.917.008-12.957 2.709-1.817a49.439 49.439 0 0 0 22.066-41.224v-2.667h8.25c13.659 0 24.774-11.115 24.774-24.774 0-4.575-1.33-8.803-3.501-12.486l11.437-9.538a23.727 23.727 0 0 0 8.58-18.292 23.787 23.787 0 0 0-12.412-20.901L151.577 4.963c-11.916-6.499-26.979-6.499-38.912 0L37.186 46.138a23.798 23.798 0 0 0-12.412 20.901 23.76 23.76 0 0 0 8.572 18.292l11.446 9.538c-2.172 3.675-3.501 7.911-3.501 12.486 0 13.659 11.115 24.774 24.774 24.774h8.25v2.667a49.451 49.451 0 0 0 22.057 41.224l2.725 1.817v12.957l-8.209.908c-37.698 4.203-66.114 35.956-66.114 73.877v48.227H41.29v50.292C17.895 368.054 0 388.402 0 412.903c0 24.502 17.895 44.85 41.29 48.805V512h454.194V99.097H512zM297.29 280.774v82.581h-99.097v-82.581h16.516v49.548h49.548v-49.548zm-66.064 0h16.516v33.032h-16.516zM247.742 256l.017 8.258H214.71V256c0-4.558 3.7-8.258 8.258-8.258h16.516c4.558 0 8.258 3.7 8.258 8.258zm-87.808-49.16 3.353.372-9.604 25.625-9.877-9.868zM90.839 82.581v-8.258c0-4.558 3.7-8.258 8.258-8.258h66.065c4.558 0 8.258 3.7 8.258 8.258v8.258zm107.355 33.032h-8.25V99.097h8.258c4.558 0 8.258 3.7 8.258 8.258s-3.708 8.258-8.266 8.258zM41.29 67.039a7.304 7.304 0 0 1 3.799-6.4l75.479-41.175c7.094-3.857 16.037-3.857 23.123 0l75.487 41.175a7.311 7.311 0 0 1 3.79 6.4c0 2.172-.95 4.212-2.626 5.599l-13.791 11.495c-2.626-.95-5.409-1.553-8.357-1.553h-8.258v-8.258c0-13.659-11.115-24.774-24.774-24.774H99.097c-13.659 0-24.774 11.115-24.774 24.774v8.258h-8.258c-2.948 0-5.731.603-8.357 1.553l-13.8-11.495a7.253 7.253 0 0 1-2.618-5.599zm24.775 48.574c-4.558 0-8.258-3.7-8.258-8.258s3.7-8.258 8.258-8.258h8.258v16.516zm24.765 19.183.008-35.7h82.581l.008 35.7c0 11.074-5.5 21.347-14.716 27.483l-2.709 1.817a16.483 16.483 0 0 0-7.358 13.741v16.937l-16.516 16.516-16.516-16.516v-16.937c0-5.533-2.75-10.669-7.35-13.741l-2.725-1.817a32.958 32.958 0 0 1-14.707-27.483zm13.494 72.044 16.128 16.128-9.868 9.868-9.604-25.625zM41.29 265.579c0-26.591 17.986-49.218 42.991-55.825l19.844 52.885 28.003-27.995 28.003 28.003 19.844-52.885c13.51 3.601 25.22 12.032 33.032 23.593-8.712 3.84-14.815 12.527-14.815 22.644v8.258h-16.516v99.097H90.839v-99.097H74.323v33.032H41.29zm33.033 48.227v49.548H57.806v-49.548zm-57.807 99.097c0-18.217 14.815-33.032 33.032-33.032H396.388v66.065H49.548c-18.217-.001-33.032-14.815-33.032-33.033zm41.29 49.549h338.581v33.032H57.806zm421.162 33.032h-66.065V99.097h66.065zm16.516-412.903h-99.097V16.516h99.097z" fill="#334756" opacity="1" data-original="#000000" class=""></path><path d="M49.548 412.903c0 18.217 14.815 33.032 33.032 33.032s33.032-14.815 33.032-33.032-14.815-33.032-33.032-33.032-33.032 14.815-33.032 33.032zm33.033-16.516c9.109 0 16.516 7.407 16.516 16.516s-7.407 16.516-16.516 16.516-16.516-7.407-16.516-16.516c0-9.108 7.407-16.516 16.516-16.516zM132.129 412.903c0 18.217 14.815 33.032 33.032 33.032s33.032-14.815 33.032-33.032-14.815-33.032-33.032-33.032-33.032 14.815-33.032 33.032zm33.032-16.516c9.109 0 16.516 7.407 16.516 16.516s-7.407 16.516-16.516 16.516-16.516-7.407-16.516-16.516c0-9.108 7.408-16.516 16.516-16.516zM214.71 412.903c0 18.217 14.815 33.032 33.032 33.032s33.032-14.815 33.032-33.032-14.815-33.032-33.032-33.032-33.032 14.815-33.032 33.032zm33.032-16.516c9.109 0 16.516 7.407 16.516 16.516s-7.407 16.516-16.516 16.516-16.516-7.407-16.516-16.516c0-9.108 7.407-16.516 16.516-16.516zM297.29 412.903c0 18.217 14.815 33.032 33.032 33.032s33.032-14.815 33.032-33.032-14.815-33.032-33.032-33.032-33.032 14.815-33.032 33.032zm33.033-16.516c9.109 0 16.516 7.407 16.516 16.516s-7.407 16.516-16.516 16.516-16.516-7.407-16.516-16.516c-.001-9.108 7.407-16.516 16.516-16.516zM132.129 156.903c13.659 0 24.774-11.115 24.774-24.774h-16.516c0 4.558-3.7 8.258-8.258 8.258s-8.258-3.7-8.258-8.258h-16.516c0 13.659 11.115 24.774 24.774 24.774z" fill="#334756" opacity="1" data-original="#000000" class=""></path></g></svg>
                               &nbsp; {{\App\Utils\translate('Product_Section')}}
                            </h5>
                            <div class="px-3 py-4">
                                <div class="row gy-1">
                                    <div class="col-sm-6">
                                        <div class="input-group d-flex justify-content-end">
                                            <select name="category" id="category" class="form-control js-select2-custom w-100 category-show"
                                                    title="{{\App\Utils\translate('select category')}}">
                                                <option value="">{{\App\Utils\translate('all_categories')}}</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item['id'] }}" {{$category==$item->id?'selected':''}}>{{ Str::limit($item['name'],15) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <form class="">
                                            <div class="input-group-overlay input-group-merge input-group-custom">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="tio-search"></i>
                                                    </div>
                                                </div>
                                                <input id="search" autocomplete="off" type="text" name="search"
                                                    class="form-control search-bar-input"
                                                    placeholder="{{\App\Utils\translate('search_by_code_or_name')}}"
                                                    aria-label="Search here" >
                                                <diV class="pos-search-card w-4 position-absolute z-index-1 w-100">
                                                    <div id="search-box" class="card card-body search-result-box d--none"></div>
                                                </diV>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-2" id="items">
                                <div class="pos-item-wrap">
                                    @foreach($products as $product)
                                        @include('admin-views.pos._single_product',['product'=>$product])
                                    @endforeach
                                </div>
                                @if(count($products)==0)
                                    <div class="text-center p-4">
                                        <img class="mb-3 w-i5" src="{{ asset('assets/admin/img/no-data.jpg') }}" alt="{{\App\Utils\translate('Image Description')}}" >
                                        <p class="mb-0">{{ \App\Utils\translate('No_data_to_show')}}</p>
                                    </div>
                                @endif

                                <div class="table-responsive mt-4">
                                    <div class="px-4 d-flex justify-content-lg-end">
                                        {!!$products->withQueryString()->links()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php($customers = \App\Models\Customer::get())
                    <div class="order--pos-right">
                        <div class="card billing-section-wrap">
                            <h5 class="p-3 m-0 bg-light">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M56 16H45V4a1 1 0 0 0-1-1H20a1 1 0 0 0-1 1v12H8a1 1 0 0 0-1 1v35a1 1 0 0 0 1 1h21v3h-6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-6v-3h21a1 1 0 0 0 1-1V17a1 1 0 0 0-1-1zM43 34H21V9h22zm-23 2h24a1 1 0 0 0 1-1V21h7v21H12V21h7v14a1 1 0 0 0 1 1zM43 5v2H21V5zM19 18v1h-8a1 1 0 0 0-1 1v23a1 1 0 0 0 1 1h42a1 1 0 0 0 1-1V20a1 1 0 0 0-1-1h-8v-1h10v27H9V18zm21 41H24v-1h16zm-7-3h-2v-3h2zM9 51v-4h46v4zm24-2a1 1 0 1 1-1-1 1 1 0 0 1 1 1zm-9-37a1 1 0 1 1 1 1 1 1 0 0 1-1-1zm1 16h14a1 1 0 0 0 1-1V15a1 1 0 0 0-1-1H25a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1zm1-8h6v6h-6zm8 6v-6h4v6zm4-10v2H26v-2zm-11-4a1 1 0 0 1 1-1h8a1 1 0 0 1 0 2h-8a1 1 0 0 1-1-1zm13 19a1 1 0 0 1-1 1h-6a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1z" fill="#334756" opacity="1" data-original="#000000" class=""></path></g></svg>
                               &nbsp; {{\App\Utils\translate('Billing_Section')}}
                            </h5>
                            <div>
                                <div class="card-body pb-0">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="flex-grow-1">
                                            <select id='customer' name="customer_id"
                                                    class="form-control js-data-example-ajax customer-change">
                                                <option>{{\App\Utils\translate('--select-customer--')}}</option>
                                                <option value="0">{{\App\Utils\translate('walking_customer')}}</option>
                                            </select>
                                        </div>
                                        <div class="">
                                            <button class="w-i6 d-inline-block btn btn-success rounded text-nowrap" id="add_new_customer" type="button" data-toggle="modal" data-target="#add-customer" title="{{\App\Utils\translate('Add Customer')}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" viewBox="0 0 50 50" fill="#FFFFFF">
                                                    <path d="M21.980469 2C18.136719 2.085938 15.375 3.199219 13.765625 5.3125C11.949219 7.703125 11.632813 11.265625 12.796875 16.195313C12.386719 16.726563 12.011719 17.574219 12.109375 18.734375C12.402344 20.898438 13.230469 21.789063 13.898438 22.152344C14.234375 23.953125 15.21875 25.863281 16.101563 26.765625C16.105469 26.988281 16.109375 27.203125 16.113281 27.417969C16.132813 28.375 16.144531 29.203125 16.019531 30.265625C15.816406 30.792969 15.402344 31.234375 14.839844 31.632813L17.984375 35.421875L20.921875 31.773438C21.1875 31.445313 21.617188 31.140625 22 31.257813C22.378906 31.140625 22.8125 31.445313 23.078125 31.773438L23.742188 32.597656C23.9375 32.800781 24.132813 33.039063 24.316406 33.3125L26.234375 35.632813C26.082031 36.398438 26 37.191406 26 38L25.992188 38C25.691406 37.996094 25.410156 37.859375 25.21875 37.625L23.234375 35.15625L22.5 35.800781C22.5 35.800781 24.269531 38.757813 24.765625 42L19.238281 42C19.742188 38.8125 21.5 35.800781 21.5 35.800781L20.742188 35.1875L18.78125 37.625C18.589844 37.859375 18.308594 37.996094 18.007813 38L18 38C17.703125 38 17.421875 37.867188 17.230469 37.640625L13.042969 32.597656C12.4375 32.871094 11.78125 33.132813 11.09375 33.40625C7.191406 34.949219 2.335938 36.875 2 42.945313L1.945313 44L27.628906 44C29.710938 47.578125 33.578125 50 38 50C44.609375 50 50 44.605469 50 38C50 31.394531 44.609375 26 38 26C34.039063 26 30.527344 27.945313 28.339844 30.921875C28.183594 30.738281 28.050781 30.546875 27.960938 30.339844C27.902344 29.128906 27.800781 27.191406 27.800781 26.753906C28.667969 25.839844 29.585938 23.925781 29.96875 22.191406C30.6875 21.851563 31.589844 20.96875 31.796875 18.683594C31.890625 17.558594 31.582031 16.734375 31.15625 16.199219C31.816406 14.128906 32.9375 9.535156 31.09375 6.488281C30.253906 5.101563 28.941406 4.230469 27.183594 3.882813C26.214844 2.664063 24.398438 2 21.980469 2 Z M 22 4C23.890625 4 25.253906 4.476563 25.734375 5.304688L25.980469 5.722656L26.457031 5.789063C27.835938 5.984375 28.792969 6.550781 29.378906 7.523438C30.664063 9.640625 30.007813 13.5 29.058594 16.160156L28.742188 16.984375L29.535156 17.382813C29.625 17.445313 29.863281 17.789063 29.804688 18.507813C29.667969 19.988281 29.199219 20.382813 29.097656 20.402344L28.234375 20.402344L28.109375 21.261719C27.835938 23.183594 26.683594 25.15625 26.304688 25.433594L25.800781 25.71875L25.800781 26.300781C25.800781 27.335938 25.804688 28.183594 25.832031 29.125L22 31.253906L18.109375 29.09375C18.128906 28.503906 18.121094 27.945313 18.109375 27.378906C18.105469 27.035156 18.097656 26.679688 18.097656 26.296875L18.035156 25.734375L17.609375 25.4375C17.214844 25.167969 15.972656 23.171875 15.796875 21.304688L15.78125 20.40625L14.875 20.40625C14.730469 20.351563 14.285156 19.878906 14.09375 18.515625C14.027344 17.679688 14.453125 17.332031 14.453125 17.332031L15.046875 16.9375L14.871094 16.253906C13.707031 11.667969 13.867188 8.484375 15.359375 6.523438C16.578125 4.921875 18.820313 4.070313 22 4 Z M 38 28C43.523438 28 48 32.476563 48 38C48 43.523438 43.523438 48 38 48C32.476563 48 28 43.523438 28 38C28 32.476563 32.476563 28 38 28 Z M 37 32L37 37L32 37L32 39L37 39L37 44L39 44L39 39L44 39L44 37L39 37L39 32Z" fill="#FFFFFF" />
                                                </svg>
                                                {{ \App\Utils\translate('customer')}}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="input-label text-capitalize" >
                                            {{\App\Utils\translate('current_customer')}} :
                                            <span class="style-i4" id="current_customer"></span>
                                        </label>
                                    </div>

                                    <div class="d-flex gap-2 flex-wrap align-items-center mb-3">
                                        <div class="flex-grow-1">
                                            <select id='cart_id' name="cart_id"
                                                    class=" form-control js-select2-custom cart-change">
                                            </select>
                                        </div>

                                        <div>
                                            <a class="w-i6 d-inline-block btn btn-danger rounded" href="{{route('admin.pos.clear-cart-ids')}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0" y="0" viewBox="0 0 753.23 753.23" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M494.308 659.077c12.993 0 23.538-10.546 23.538-23.539V353.077c0-12.993-10.545-23.539-23.538-23.539s-23.538 10.545-23.538 23.539v282.461c0 12.993 10.544 23.539 23.538 23.539zm141.23-564.923h-141.23V47.077C494.308 21.067 473.24 0 447.23 0H306c-26.01 0-47.077 21.067-47.077 47.077v47.077h-141.23c-26.01 0-47.077 21.067-47.077 47.077v47.077c0 25.986 21.067 47.077 47.077 47.077v423.692c0 51.996 42.157 94.153 94.154 94.153h329.539c51.996 0 94.153-42.157 94.153-94.153V235.385c26.01 0 47.077-21.091 47.077-47.077V141.23c-.001-26.009-21.068-47.076-47.078-47.076zM306 70.615c0-12.993 10.545-23.539 23.538-23.539h94.154c12.993 0 23.538 10.545 23.538 23.539v23.539H306V70.615zm282.461 588.462c0 25.986-21.066 47.076-47.076 47.076H211.846c-26.01 0-47.077-21.09-47.077-47.076V235.385h423.692v423.692zM612 188.308H141.23c-12.993 0-23.538-10.545-23.538-23.539s10.545-23.539 23.538-23.539H612c12.993 0 23.538 10.545 23.538 23.539S624.993 188.308 612 188.308zM258.923 659.077c12.993 0 23.539-10.546 23.539-23.539V353.077c0-12.993-10.545-23.539-23.539-23.539s-23.539 10.545-23.539 23.539v282.461c0 12.993 10.546 23.539 23.539 23.539zm117.692 0c12.993 0 23.538-10.546 23.538-23.539V353.077c0-12.993-10.545-23.539-23.538-23.539s-23.539 10.545-23.539 23.539v282.461c.001 12.993 10.546 23.539 23.539 23.539z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                                                {{ \App\Utils\translate('clear_cart')}}
                                            </a>
                                        </div>

                                        <div>
                                            <a class="w-i6 d-inline-block btn btn-success rounded" href="{{route('admin.pos.new-cart-id')}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#ffffff" d="M12 4a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2h-6v6a1 1 0 1 1-2 0v-6H5a1 1 0 1 1 0-2h6V5a1 1 0 0 1 1-1z" opacity="1" data-original="#000000" class=""></path></g></svg>
                                                {{ \App\Utils\translate('new_order')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <div id="cartloader" class="d-none">
                                            <img width="50" src="{{asset('assets/admin/img/loader.gif')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cart">
                                @include('admin-views.pos._cart',['cart_id'=>$cartId])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="quick-view" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" id="quick-view-modal">

                </div>
            </div>
        </div>
        @php($order=\App\Models\Order::find(session('last_order')))
        @if($order)
            @php(session(['last_order'=> false]))
            <div class="modal fade" id="print-invoice" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content modal-content1">
                        <div class="modal-header">
                            <h5 class="modal-title">{{\App\Utils\translate('print_invoice')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-dark" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row font-i1">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-around">
                                    <a id="invoice_close" data-route="{{url()->previous()}}"
                                        class="w-i2 d-inline-block btn btn-danger rounded text-nowrap non-printable invoice-close">
                                        <svg width="20" height="20" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_186_7)">
                                                <path d="M496.053 241.657H52.2708L185.032 109.406C191.267 103.17 191.267 93.0761 185.032 86.8564C178.796 80.6208 168.702 80.6208 162.482 86.8564L4.60511 244.719C-1.53504 250.859 -1.53504 261.128 4.60511 267.268L162.483 425.147C168.719 431.382 178.813 431.382 185.033 425.147C191.269 418.911 191.269 408.817 185.033 402.597L52.2708 273.55H496.052C504.855 273.55 511.999 266.405 511.999 257.603C511.999 248.802 504.855 241.657 496.053 241.657Z" fill="white"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_186_7">
                                                    <rect width="512" height="512" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                    <button id="print_invoice" class="non-printable ml-2 print-div w-i2 d-inline-block btn btn-success rounded text-nowrap" data-name="printableArea">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><defs><clipPath id="a" clipPathUnits="userSpaceOnUse"><path d="M0 512h512V0H0Z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></clipPath></defs><g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)"><path d="M0 0h-76c-22.092 0-40 17.909-40 40v160c0 22.091 17.908 40 40 40h392c22.092 0 40-17.909 40-40V40c0-22.091-17.908-40-40-40h-76" style="stroke-width:40;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(136 136)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20S0 11.046 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(116 296)" fill="#ffffff" data-original="#000000" opacity="1" class=""></path><path d="M0 0c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20S0 11.046 0 0" style="fill-opacity:1;fill-rule:nonzero;stroke:none" transform="translate(196 296)" fill="#ffffff" data-original="#000000" opacity="1" class=""></path><path d="M0 0v-196h-240V0" style="stroke-width:40;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(376 216)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0v116h240V0" style="stroke-width:40;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(136 376)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0h320" style="stroke-width:40;stroke-linecap:square;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(96 216)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="square" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path></g></g></svg>
                                    </button>
                                </div>
                                <hr class="non-printable">
                            </div>
                            <div class="row m-auto" id="printableArea">
                                @include('admin-views.pos.order.invoice')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <script src="{{asset('assets/admin')}}/js/vendor.min.js"></script>
    <script src="{{asset('assets/admin')}}/js/theme.min.js"></script>
    <script src="{{asset('assets/admin')}}/js/sweet_alert.js"></script>
    <script src="{{asset('assets/admin')}}/js/toastr.js"></script>
    <script src="{{asset('assets/admin')}}/js/pos.js"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        "use strict";

        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

<script>
    "use strict";

    $(document).on('click', '#logoutLink', function(e) {
        e.preventDefault();

        Swal.fire({
            title: '{{\App\Utils\translate('Do you want to logout')}}?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonColor: '#FC6A57',
            cancelButtonColor: '#363636',
            confirmButtonText: `{{\App\Utils\translate('Yes')}}`,
            denyButtonText: `{{\App\Utils\translate('Don\'t Logout')}}'`,
        }).then((result) => {
            if (result.value) {
                window.location.href = '{{route('admin.auth.logout')}}';
            } else {
                Swal.fire('{{\App\Utils\translate('Canceled')}}', '', '{{\App\Utils\translate('info')}}');
            }
        });
    });

    $(document).on('ready', function () {

        $(".print-div").on('click', function(){
            let divName = $(this).data('name');
            printDiv(divName);
        });

        $(".invoice-close").on('click', function(){
            window.location.href = $(this).data('route');
        });

        $('.category-show').on('change', function() {
            set_category_filter($(this).val());
        });

        $('.cart-change').on('change', function() {
            cart_change($(this).val());
        });

        $('.customer-change').on('change', function() {
            customer_change($(this).val());
        });

        $(".single-cart-data").on('click', function(){
            let order_id = $(this).data('id');
            addToCart(order_id);
        });

        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });

        $('#search').focus();
        $.ajax({
            url: '{{route('admin.pos.get-cart-ids')}}',
            type: 'GET',

            dataType: 'json',
            beforeSend: function () {
                $("#my-loader").show();
            },
            success: function (data) {
                var output = '';
                    for(var i=0; i<data.cart_nam.length; i++) {
                        output += `<option value="${data.cart_nam[i]}" ${data.current_user==data.cart_nam[i]?'selected':''}>${data.cart_nam[i]}</option>`;
                    }
                    $('#cart_id').html(output);
                    $('#current_customer').text(data.current_customer);
                    $('#cart').empty().html(data.view);
                    if(data.user_type === 'sc')
                    {
                        console.log('after add');
                        customer_Balance_Append(data.user_id);
                    }
            },
            complete: function () {
                $("#my-loader").hide();
            },
        });
    });

    $(document).on('ready', function(){

        $(".direction-toggle").on("click", function () {
            setDirection(localStorage.getItem("direction"));
        });

        function setDirection(direction) {
            if (direction == "rtl") {
                localStorage.setItem("direction", "ltr");
                $("html").attr('dir', 'ltr');
            $(".direction-toggle").find('span').text('Toggle RTL')
            } else {
                localStorage.setItem("direction", "rtl");
                $("html").attr('dir', 'rtl');
            $(".direction-toggle").find('span').text('Toggle LTR')
            }
        }

        if (localStorage.getItem("direction") == "rtl") {
            $("html").attr('dir', "rtl");
            $(".direction-toggle").find('span').text('Toggle LTR')
        } else {
            $("html").attr('dir', "ltr");
            $(".direction-toggle").find('span').text('Toggle RTL')
        }

    })

    function payment_option(val) {
        if ($(val).val() != 1 && $(val).val() != 0) {
            $("#collected_cash").addClass('d-none');
            $("#returned_amount").addClass('d-none');
            $("#balance").addClass('d-none');
            $("#remaining_balance").addClass('d-none');
            $("#transaction_ref").removeClass('d-none');
            $('#cash_amount').attr('required',false);
            console.log($(val).val());
        } else if ($(val).val() == 1) {
            $("#collected_cash").removeClass('d-none');
            $("#returned_amount").removeClass('d-none');
            $("#transaction_ref").addClass('d-none');
            $("#balance").addClass('d-none');
            $("#remaining_balance").addClass('d-none');
            console.log($(val).val());

        } else if($(val).val() == 0){
            $("#balance").removeClass('d-none');
            $("#remaining_balance").removeClass('d-none');
            $("#collected_cash").addClass('d-none');
            $("#returned_amount").addClass('d-none');
            $("#transaction_ref").addClass('d-none');
            $('#cash_amount').attr('required',false);
            let customerId = $('#customer').val();
            $.ajax({
            url: '{{route('admin.pos.customer-balance')}}',
            type: 'GET',
            data: {
                customer_id: customerId
            },
            dataType: 'json',
            beforeSend: function () {
                $("#my-loader").show();
                console.log("loding");
            },
            success: function (data) {
                console.log(data.customer_balance);
                let balance = data.customer_balance;
                let order_total = $('#total_price').text();
                let remain_balance = parseInt(balance) - parseInt(order_total);
                $('#balance_customer').val(balance);
                $('#balance_remain').val(remain_balance);
            },
            complete: function () {
                $("#my-loader").hide();
                console.log("complete");
            },
        });
        }
    }

    function customer_change(val) {
        $.post({
                url: '{{route('admin.pos.remove-coupon')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    user_id:val
                },
                beforeSend: function () {
                    $("#my-loader").show();
                },
                success: function (data) {
                    var output = '';
                    for(var i=0; i<data.cart_nam.length; i++) {
                        output += `<option value="${data.cart_nam[i]}" ${data.current_user==data.cart_nam[i]?'selected':''}>${data.cart_nam[i]}</option>`;
                    }
                    $('#cart_id').html(output);
                    $('#current_customer').text(data.current_customer);
                    $('#cart').empty().html(data.view);
                    customer_Balance_Append(val);
                },
                complete: function () {
                    $("#my-loader").hide();
                }
            });
    }

    function cart_change(val)
    {
        let  cart_id = val;
        let url = "{{route('admin.pos.change-cart')}}"+'/?cart_id='+val;
        document.location.href=url;
    }

    function extra_discount()
    {
        let discount = $('#dis_amount').val();
        console.log(discount);
        let type = $('#type_ext_dis').val();
        if(discount)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.pos.discount') }}',
                data: {
                    _token: '{{csrf_token()}}',
                    discount:discount,
                    type:type,
                },
                beforeSend: function () {
                    $("#my-loader").show();
                },
                success: function (data) {
                    if(data.extra_discount==='success')
                    {
                        toastr.success('{{ \App\Utils\translate('extra_discount_added_successfully') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else if(data.extra_discount==='empty')
                    {
                        toastr.warning('{{ \App\Utils\translate('your_cart_is_empty') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });

                    }else{
                        toastr.warning('{{ \App\Utils\translate('this_discount_is_not_applied_for_this_amount') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }

                    $('.modal-backdrop').addClass('d-none');
                    $('#cart').empty().html(data.view);
                    if(data.user_type === 'sc')
                    {
                        customer_Balance_Append(data.user_id);
                    }
                    $('#search').focus();
                },
                complete: function () {
                    $('.modal-backdrop').addClass('d-none');
                    $(".footer-offset").removeClass("modal-open");
                    $("#my-loader").hide();
                }
            });
        }
    }

    function coupon_discount()
    {
        let  coupon_code = $('#coupon_code').val();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.pos.coupon-discount')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    coupon_code:coupon_code,
                },
                beforeSend: function () {
                    $("#my-loader").show();
                },
                success: function (data) {
                    console.log(data);
                    if(data.coupon === 'success')
                    {
                        toastr.success('{{ \App\Utils\translate('coupon_added_successfully') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else if(data.coupon === 'amount_low')
                    {
                        toastr.warning('{{ \App\Utils\translate('this_discount_is_not_applied_for_this_amount') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else if(data.coupon === 'cart_empty')
                    {
                        toastr.warning('{{ \App\Utils\translate('your_cart_is_empty') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                    else {
                        toastr.warning('{{ \App\Utils\translate('coupon_is_invalid') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }

                    $('#cart').empty().html(data.view);
                    if(data.user_type === 'sc')
                    {
                        customer_Balance_Append(data.user_id);
                    }
                    $('#search').focus();
                },
                complete: function () {
                    $('.modal-backdrop').addClass('d-none');
                    $(".footer-offset").removeClass("modal-open");
                    $('#my-loader').hide();
                }
            });

    }

    $(document).on('ready', function () {
        @if($order)
            $('#print-invoice').modal('show');
        @endif
    });

    function set_category_filter(id) {
        var nurl = new URL('{!!url()->full()!!}');
        nurl.searchParams.set('category_id', id);
        location.href = nurl;
    }

    $('#search-form').on('submit', function (e) {
        e.preventDefault();
        var keyword = $('#datatableSearch').val();
        var nurl = new URL('{!!url()->full()!!}');
        nurl.searchParams.set('keyword', keyword);
        location.href = nurl;
    });

    function quickView(product_id) {
        $.ajax({
            url: '{{route('admin.pos.quick-view')}}',
            type: 'GET',
            data: {
                product_id: product_id
            },
            dataType: 'json',
            beforeSend: function () {
                $("#my-loader").show();
            },
            success: function (data) {
                $('#quick-view').modal('show');
                $('#quick-view-modal').empty().html(data.view);
            },
            complete: function () {
                $("#my-loader").hide();
            },
        });
    }

    function addToCart(form_id) {
        let productId = form_id;
        let productQty = $('#product_qty').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.pos.add-to-cart') }}',
                data: {
                    _token: '{{csrf_token()}}',
                    id:productId,
                    quantity:productQty,
                },
                beforeSend: function () {
                    $('#cartloader').removeClass('d-none');
                },
                success: function (data) {
                    if(data.qty==0)
                    {
                        toastr.warning('{{\App\Utils\translate('product_quantity_end!')}}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else{
                        toastr.success('{{\App\Utils\translate('item_has_been_added_in_your_cart!')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    }

                    $('#cart').empty().html(data.view);
                    if(data.user_type === 'sc')
                    {
                        customer_Balance_Append(data.user_id);
                    }
                    $('#search').val('').focus();
                    $('#search-box').addClass('d-none');
                },
                complete: function () {
                    $('#cartloader').addClass('d-none');

                }
            });

    }

    function removeFromCart(key) {
        $.post('{{ route('admin.pos.remove-from-cart') }}', {_token: '{{ csrf_token() }}', key: key}, function (data) {

                $('#cart').empty().html(data.view);
                if(data.user_type === 'sc')
                {
                    customer_Balance_Append(data.user_id);
                }
                toastr.info('{{\App\Utils\translate('item_has_been_removed_from_cart')}}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            $('#search').focus();

        });
    }

    function emptyCart() {
        Swal.fire({
            title: '{{\App\Utils\translate('Are_you_sure?')}}',
            text: '{{\App\Utils\translate('You_want_to_remove_all_items_from_cart!!')}}',
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#161853',
            cancelButtonText: '{{\App\Utils\translate('No')}}',
            confirmButtonText: '{{\App\Utils\translate('Yes')}}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post('{{ route('admin.pos.emptyCart') }}', {_token: '{{ csrf_token() }}'}, function (data) {
                    $('#cart').empty().html(data.view);
                    $('#search').focus();
                    if(data.user_type === 'sc')
                    {
                        customer_Balance_Append(data.user_id);
                    }
                    toastr.info('{{\App\Utils\translate('Item_has_been_removed_from_cart')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                });
            }
        })

    }

    function updateCart() {
        $.post('<?php echo e(route('admin.pos.cart_items')); ?>', {_token: '<?php echo e(csrf_token()); ?>'}, function (data) {
            $('#cart').empty().html(data);

        });
    }

    function updateQuantity(id,qty) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.post({
            url: '{{ route('admin.pos.updateQuantity') }}',
            data: {
                _token: '{{csrf_token()}}',
                key: id,
                quantity: qty,
            },
            beforeSend: function () {
                $("#my-loader").show();
            },
            success: function (data) {
                if(data.qty<0)
                {
                    toastr.warning('{{\App\Utils\translate('product_quantity_is_not_enough!')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
                if(data.upQty==='zeroNegative')
                {
                    toastr.warning('{{\App\Utils\translate('Product_quantity_can_not_be_zero_or_less_than_zero_in_cart!')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }

                $('#search').focus();
                $('#cart').empty().html(data.view);
                if(data.user_type === 'sc')
                {
                    customer_Balance_Append(data.user_id);
                }
            },
            complete: function () {
                $("#my-loader").hide();
            }
        });



    }

    $('.js-select2-custom').each(function () {
        var select2 = $.HSCore.components.HSSelect2.init($(this));
    });

    $('.js-data-example-ajax').select2({
        ajax: {
            url: '{{route('admin.pos.customers')}}',
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            __port: function (params, success, failure) {
                var $request = $.ajax(params);

                $request.then(success);
                $request.fail(failure);

                return $request;
            }
        }
    });

    jQuery(".search-bar-input").on('keyup',function () {
        $(".search-card").removeClass('d-none').show();
        let name = $(".search-bar-input").val();
        if (name.length >0) {
            $('#search-box').removeClass('d-none').show();
            $.get({
                url: '{{route('admin.pos.search-products')}}',
                dataType: 'json',
                data: {
                    name: name
                },
                beforeSend: function () {
                    $("#my-loader").show();
                },
                success: function (data) {
                    if (data.count == 0) {
                        $('#search-box').addClass('d-none');
                    }
                    $('.search-result-box').empty().html(data.result);
                },
                complete: function () {
                    $("#my-loader").hide();
                },
            });
        } else {
            $('.search-result-box').empty();
            $('#search-box').addClass('d-none');
        }
    });

    jQuery(".search-bar-input").on('keyup',delay(function () {
        $(".search-card").removeClass('d-none').show();
        let name = $(".search-bar-input").val();
        if (name.length > 0 || isNaN(name)) {
            $.get({
                url: '{{route('admin.pos.search-by-add')}}',
                dataType: 'json',
                data: {
                    name: name
                },
                success: function (data) {
                    if (data.count == 1) {
                        $('#search').attr("disabled", true);
                        addToCart(data.id);
                        $('#search').attr("disabled", false);
                        $('.search-result-box').empty().html(data.result);
                        $('#search').val('');
                        $('#search-box').addClass('d-none');
                    }
                },
            });
        } else {
            $('.search-result-box').empty();
        }
    },1000));

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#my-loader').style.display = 'none';
    });
</script>
@stack('script_2')
</body>
</html>
