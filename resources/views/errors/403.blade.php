<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
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

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- error-403 start-->
      <div class="error-wrapper">
        <div class="container"><img class="img-100" src="{{ asset('assets/admin/sad.png') }}" alt="">
          <div class="error-heading">
            <h2 class="headline font-primary">403</h2>
          </div>
          <div class="col-md-8 offset-md-2">
            <p class="sub-content">You are not authorized to perform this action</p>
          </div>
          <div><a class="btn btn-primary btn-lg" href="/">BACK TO HOME PAGE</a></div>
        </div>
      </div>
      <!-- error-403 end-->
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
