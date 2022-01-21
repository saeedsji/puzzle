<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <title> @yield('title') - پنل مدیریتی  </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="The best advertising platform" name="description">
    <meta content="Saeed jalali" name="author">
    <link rel="shortcut icon" href="/assets/panel/images/favicon.ico">
    <link href="/assets/panel/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <link href="/assets/panel/css/icons.css" rel="stylesheet" type="text/css">
    <link href="/assets/panel/css/app.css" id="app-style" rel="stylesheet" type="text/css">
    <link href="/assets/panel/css/style.css" id="app-style" rel="stylesheet" type="text/css">
    <meta name="theme-color" content="#283D92">

    @yield('style')

</head>

<body data-layout="detached" data-topbar="colored">

<div class="container-fluid">

    <div id="layout-wrapper">

       @include('admin.components.header')

       @include('admin.components.menu')

        <div class="main-content">

            <div class="page-content">
            @yield('content')
            </div>

        </div>

    </div>


</div>


<script src="/assets/panel/libs/jquery/jquery.min.js"></script>
<script src="/assets/panel/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/panel/libs/metismenu/metisMenu.min.js"></script>

<script src="/assets/panel/libs/node-waves/waves.min.js"></script>
<script src="/assets/panel/js/app.js"></script>

@yield('script')

@include('sweetalert::alert')

</body>

</html>
