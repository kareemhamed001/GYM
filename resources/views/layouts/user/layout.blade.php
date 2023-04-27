<!DOCTYPE html>
<html lang="">
<head>

    <title>X_Fitness</title>
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

</head>
<body class="mw-100 position-relative">

<header class="w-100 position-relative">
    @include('layouts.user.header')
</header>


<div class="w-100">
    @yield('content')
</div>
<script src="{{asset('assets/js/font-awesome/all.min.js')}}"></script>
<script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
