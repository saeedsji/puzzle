<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <title> @yield('title') - پنل مدیریتی  </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/panel/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/assets/panel/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="/assets/panel/css/icons.css" rel="stylesheet" type="text/css">
    <!-- App Css -->
    <link href="/assets/panel/css/app.css" id="app-style" rel="stylesheet" type="text/css">
    <link href="/assets/panel/css/style.css" id="app-style" rel="stylesheet" type="text/css">
    <!-- Theme Color -->
    <meta name="theme-color" content="#283D92">

</head>

<body>
<div class="home-btn d-none d-sm-block">
    <a href="/" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-sm-5">
    @yield('content')

</div>

<!-- JAVASCRIPT -->
<script src="/assets/panel/libs/jquery/jquery.min.js"></script>
<script src="/assets/panel/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/panel/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/panel/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/panel/libs/node-waves/waves.min.js"></script>

<script src="/assets/panel/js/app.js"></script>
@include('sweetalert::alert')

</body>

</html>
