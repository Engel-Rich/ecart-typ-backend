<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"
        content="admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="jejookit">
    <link rel="icon" href="{{ asset('assets/signin/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/signin/images/favicon.png') }}" type="image/x-icon">
    <title>{{\App\Utils\translate('admin')}} | {{\App\Utils\translate('login')}}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/icon-set/style.css')}}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/signin/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/signin/css/style.css') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/signin/css/responsive.css') }}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/auth-page.css')}}">
</head>

<body>
    <div class="loader-wrapper" id="my-loader">
        <span class="loader"></span>
    </div>
    @php($shop_logo=\App\Models\BusinessSetting::where(['key'=>'shop_logo'])->first()->value)
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div>
                            <a class="logo" href="/">
                                <img class="img-fluid for-light" width="120" src="{{onErrorImage($shop_logo,asset('storage/shop').'/' . $shop_logo,asset('assets/admin/img/ecartify.png') ,'shop/')}}" alt="looginpage">
                                <img class="img-fluid for-dark" width="120" src="{{onErrorImage($shop_logo,asset('storage/shop').'/' . $shop_logo,asset('assets/admin/img/ecartify.png') ,'shop/')}}" alt="looginpage">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="js-validate theme-form" action="{{route('admin.auth.login')}}" method="post">
                                    @csrf
                                <h4>{{ \App\Utils\translate('Sign In') }}</h4>
                                <p>{{ \App\Utils\translate('Welcome Back. Login to your panel') }}</p>
                                <div class="form-group">
                                    <label class="col-form-label">{{ \App\Utils\translate('Your email') }}</label>
                                    <input
                                        class="form-control"
                                        type="email"
                                        name="email"
                                        id="signinEmail"
                                        tabindex="1" placeholder="{{\App\Utils\translate('email@address.com')}}"
                                        aria-label="{{\App\Utils\translate('email@address.com')}}"
                                        required
                                        data-msg="{{\App\Utils\translate('Please_enter_a_valid_email_address.')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">{{ \App\Utils\translate('Password') }}</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control"
                                            type="password"
                                            name="password"
                                            id="signinPassword"
                                            placeholder="{{\App\Utils\translate('8+ characters required')}}"
                                            aria-label="{{\App\Utils\translate('8+ characters required')}}" required
                                            data-msg="{{\App\Utils\translate('Your password is invalid. Please try again.')}}"
                                        >
                                        <div class="show-hide"><span class="show"> </span></div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">{{\App\Utils\translate('sign_in')}}</button>
                                    </div>
                                </div>
                            </form>
                            @if(env('APP_MODE')=='false')
                                <div class="auto-fill-data-copy mt-4">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div>
                                            <span class="d-block"><strong>{{\App\Utils\translate('Email')}} </strong> : {{\App\Utils\translate('admin@admin.com')}}</span>
                                            <span class="d-block"><strong>{{\App\Utils\translate('Password')}} </strong> : {{\App\Utils\translate('12345678')}}</span>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary copy_cred"><i class="tio-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets/signin/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/signin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- Theme js-->
    <script src="{{ asset('assets/signin/js/login.js') }}"></script>
    <script src="{{asset('assets/admin/js/toastr.js')}}"></script>
    {!! Toastr::message() !!}

    @if ($errors->any())
        <script>
            "use strict";
            @foreach($errors->all() as $error)
                toastr.error('{{$error}}', 'Error', {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                });
            @endforeach
        </script>
    @endif

    <script>
        const rootEl = document.documentElement;

        const isRtl = localStorage.getItem("direction") === "rtl";

        if(isRtl){
            rootEl.setAttribute("dir", "rtl");
        }
        else {
            rootEl.setAttribute("dir", "ltr");
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('#my-loader').style.display = 'none';
        });
    </script>
    <script src="{{asset('assets/admin')}}/js/auth-page.js"></script>
</body>

</html>
