<!doctype html>
<html lang="en" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Webns Technology Ltd.">
    <meta name="author" content="Webns Technology Ltd.">
    <meta name="keywords" content="Webns Technology Ltd. | Admin Login">

    <!-- TITLE -->
    <title>Admin Login</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}admin/images/brand/favicon.png" />

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('/') }}admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('/') }}admin/css/style.css" rel="stylesheet" />
    <link href="{{ asset('/') }}admin/css/skin-modes.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('/') }}admin/plugins/icons/icons.css" rel="stylesheet" />

    <!-- INTERNAL Switcher css -->
    <link href="{{ asset('/') }}admin/switcher/demo.css" rel="stylesheet">

</head>

<body class="ltr login-img">

<!-- PAGE -->
<div class="page">
    <div>
        <!-- CONTAINER OPEN -->
        <div class="col col-login mx-auto text-center">
            <a href="index.html" class="text-center">
                <img src="{{ asset('/') }}admin/images/brand/webns.png" class="header-brand-img" alt="">
            </a>
        </div>
        <div class="container-login100">
            <div class="wrap-login100 p-0">
                <div class="card-body">
                    <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <span class="login100-form-title">
                            Login
                        </span>
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="login" placeholder="Email or Employee ID">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="zmdi zmdi-email" aria-hidden="true"></i>
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('login')" class="mt-2" />
                        <div class="wrap-input100 validate-input" data-bs-validate = "Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn btn-primary fw-bold fs-16" >
                                Login
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>
<!-- End PAGE -->

<!-- JQUERY JS -->
<script src="{{ asset('/') }}admin/plugins/jquery/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('/') }}admin/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{ asset('/') }}admin/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{ asset('/') }}admin/plugins/p-scroll/perfect-scrollbar.js"></script>

<!-- STICKY JS -->
<script src="{{ asset('/') }}admin/js/sticky.js"></script>

<!-- COLOR THEME JS -->
<script src="{{ asset('/') }}admin/js/themeColors.js"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('/') }}admin/js/custom.js"></script>

</body>

</html>

