<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    {{--    <link rel="icon" type="image/x-icon" href=""/>--}}
    <link href="{{asset('assets/css/font-awesome/all.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/layouts/modern-light-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('assets/layouts/modern-light-menu/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('assets/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css"/>


    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('styles')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->


</head>
<body class="layout-boxed">

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
@include('layouts.includes.header')

<!--  END NAVBAR  -->
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container " id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    @include('layouts.includes.sidebar')
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">

            <div class="layout-px-spacing">
            @yield('content')
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<script src="{{asset('assets/js/font-awesome/all.min.js')}}"></script>
<script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    function previewImage(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                const preview = document.getElementById("preview");
                preview.src = reader.result;
            });

            reader.readAsDataURL(file);
        }
    }
</script>
<script>


    // Add remove loading class on body element based on Ajax request status
    $(document).on({
        ajaxStart: function(){
            $("body").addClass("loading");
        },
        ajaxStop: function(){
            $("body").removeClass("loading");
        }
    });
</script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('scripts')
<script src="{{asset('assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
<script src="{{asset('assets/src/plugins/src/waves/waves.min.js')}}"></script>
<script src="{{asset('assets/layouts/modern-light-menu/app.js')}}"></script>
<script src="{{asset('assets/src/plugins/src/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('assets/src/plugins/src/global/vendors.min.js')}}"></script>
<script src="{{asset('assets/src/assets/js/custom.js')}}"></script>
{{--<script src="{{asset('assets/src/assets/js/scrollspyNav.js')}}"></script>--}}
<!-- END GLOBAL MANDATORY STYLES -->
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>
