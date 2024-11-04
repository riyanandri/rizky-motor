<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/favicon.ico') }}">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/vendor/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('front/css/vendor/font-awesome.css') }}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{ asset('front/css/vendor/fontawesome-stars.css') }}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{ asset('front/css/vendor/ion-fonts.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins/slick.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins/animate.css') }}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins/jquery-ui.min.css') }}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins/lightgallery.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins/nice-select.css') }}">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from the above) -->
    <!--
    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    -->

    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <!--<link rel="stylesheet" href="assets/css/style.min.css">-->

</head>

<body class="template-color-1">

<div class="main-wrapper">

    <!-- Begin Uren's Newsletter Popup Area -->
{{--    @include('layouts.partials.pop-up')--}}
    <!-- Uren's Newsletter Popup Area Here -->

    <!-- Begin Uren's Header Main Area -->
    @include('layouts.partials.header')
    <!-- Uren's Header Main Area End Here -->

    @yield('content')

    @include('layouts.partials.footer-home')
    <!-- Begin Uren's Modal Area -->
    @include('layouts.partials.modal')
    <!-- Uren's Modal Area End Here -->

</div>

<!-- JS
============================================ -->
@stack('js')
<!-- jQuery JS -->
<script src="{{ asset('front/js/vendor/jquery-1.12.4.min.js') }}"></script>
<!-- Modernizer JS -->
<script src="{{ asset('front/js/vendor/modernizr-2.8.3.min.js') }}"></script>
<!-- Popper JS -->
<script src="{{ asset('front/js/vendor/popper.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('front/js/vendor/bootstrap.min.js') }}"></script>

<!-- Slick Slider JS -->
<script src="{{ asset('front/js/plugins/slick.min.js') }}"></script>
<!-- Barrating JS -->
<script src="{{ asset('front/js/plugins/jquery.barrating.min.js') }}"></script>
<!-- Counterup JS -->
<script src="{{ asset('front/js/plugins/jquery.counterup.js') }}"></script>
<!-- Nice Select JS -->
<script src="{{ asset('front/js/plugins/jquery.nice-select.js') }}"></script>
<!-- Sticky Sidebar JS -->
<script src="{{ asset('front/js/plugins/jquery.sticky-sidebar.js') }}"></script>
<!-- Jquery-ui JS -->
<script src="{{ asset('front/js/plugins/jquery-ui.min.js') }}"></script>
<script src="{{ asset('front/js/plugins/jquery.ui.touch-punch.min.js') }}"></script>
<!-- Lightgallery JS -->
<script src="{{ asset('front/js/plugins/lightgallery.min.js') }}"></script>
<!-- Scroll Top JS -->
<script src="{{ asset('front/js/plugins/scroll-top.js') }}"></script>
<!-- Theia Sticky Sidebar JS -->
<script src="{{ asset('front/js/plugins/theia-sticky-sidebar.min.js') }}"></script>
<!-- Waypoints JS -->
<script src="{{ asset('front/js/plugins/waypoints.min.js') }}"></script>
<!-- jQuery Zoom JS -->
<script src="{{ asset('front/js/plugins/jquery.zoom.min.js') }}"></script>

<!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->
<!--
<script src="front/js/vendor/vendor.min.js"></script>
<script src="front/js/plugins/plugins.min.js"></script>
-->

<!-- Main JS -->
<script src="{{ asset('front/js/main.js') }}"></script>

</body>

</html>
