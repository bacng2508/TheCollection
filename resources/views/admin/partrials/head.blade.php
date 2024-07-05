<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    {{-- From Script --}}
    <!-- jQuery -->
    <script src="{{ asset('backend/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/assets/dist/js/adminlte.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('backend/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/summernote-bs4.min.css') }}">

    {{-- CKEditor --}}
    {{-- <script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script> --}}

    {{-- CKEditor_OnlineBuilder --}}
    {{-- <script src="{{ asset('assets/vendor/ckeditor_onlineBuilder/build/ckeditor.js') }}"></script> --}}

    {{-- CKEditor 4 --}}
    <script src="{{ asset('assets/vendor/ckeditor_4/ckeditor.js') }}"></script>

    {{-- Toastr --}}
	<link rel="stylesheet" href="{{asset("frontend")}}/assets/css/toastr.min.css">

    <link rel="icon" type="image/x-icon" href="{{ asset('company') }}/logo/company_white_icon.jpg">
    
    {{-- Custom Style --}}
	<link rel="stylesheet" href="{{asset("backend")}}/css/style.css">

    <!-- StyleCSS -->
    @stack('styles')
    <!-- StyleCSS -->
    <style>
        /* .main-sidebar{
            width: 270px !important;
        }
        .main-sidebar, .main-sidebar::before {
            width: 270px !important;
        } */
        .main-sidebar, .main-sidebar::before {
            transition: margin-left .3s ease-in-out, width .3s ease-in-out;
            width: 270px;
        }

        @media (min-width: 768px) {
            body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
                transition: margin-left .3s ease-in-out;
                margin-left: 270px;
            }
        }

        
        .sidebar-mini .main-sidebar .nav-link, .sidebar-mini-md .main-sidebar .nav-link, .sidebar-mini-xs .main-sidebar .nav-link {
            /* width: calc(250px - .5rem* 2); */
            width: auto;
            transition: width ease-in-out .3s;
        }
    </style>
</head>