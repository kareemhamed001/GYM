<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo/xlogo.png')}}"/>

    <link href="{{asset('assets/css/font-awesome/all.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('assets/layouts/modern-light-menu/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('assets/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/bootstrap/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('styles')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        #ajax_loader {
            background: rgb(236, 239, 255);
            opacity: 1;
            position: fixed;
            z-index: 999999;
            top: 0px;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            display: none;
        }

        div#ajax_loader .loader {
            display: flex;
            justify-content: center;
            height: 100vh;
        }

        div#ajax_loader .loader-content {
            right: 0;
            align-self: center;
        }

        div#ajax_loader .loader-content .spinner-grow {
            width: 2.5rem;
            height: 2.5rem;
        }

        .spinner-grow {
            color: #304aca;
        }

    </style>
</head>
<body >
<div id="ajax_loader">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->

<!--  BEGIN NAVBAR  -->
@include('layouts.user.header')

<!--  END NAVBAR  -->
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container col-12 ">

    <div class="overlay"></div>
    <div class="search-overlay"></div>


    <!--  BEGIN CONTENT AREA  -->
    <div class="main-content  w-100">

        @yield('content')
    </div>
</div>
<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="">Copyright © <span class="dynamic-year">2023</span> <a href="javascript:void(0)">DesignReset</a>, All
            rights reserved.</p>
    </div>
    <div class="footer-section f-section-2">
        <p class="">Coded with
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-heart">
                <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </p>
    </div>
</div>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<script src="{{asset('assets/js/font-awesome/all.min.js')}}"></script>
<script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $(document).on('ajaxStart', function () {
            showLoader()
        });

        $(document).on('ajaxStop', function () {
            removeLoader()
        });

    });
    $(document).ajaxStart(function () {
        showLoader()
    });

    $(document).ajaxStop(function () {
        removeLoader()
    });

    function previewImage(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                const preview = document.getElementById("preview");
                preview.src = reader.result;
            });

            reader.readAsDataURL(file);
        }
    }
</script>
<script>


    function showLoader() {
        $('#ajax_loader').show()
    }

    function removeLoader() {
        $('#ajax_loader').hide()
    }
</script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('scripts')
<script src="{{asset('assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/src/waves/waves.min.js')}}"></script>

<script src="{{asset('assets/src/plugins/src/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('assets/src/plugins/src/global/vendors.min.js')}}"></script>
<script src="{{asset('assets/src/assets/js/custom.js')}}"></script>
{{--<script src="{{asset('assets/src/assets/js/scrollspyNav.js')}}"></script>--}}
<!-- END GLOBAL MANDATORY STYLES -->
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/layouts/modern-light-menu/userApp.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
