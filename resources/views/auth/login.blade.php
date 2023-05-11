<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignIn</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo/xlogo.png')}}"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/layouts/modern-light-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/layouts/modern-light-menu/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('assets/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />


    <link href="{{asset('assets/layouts/modern-light-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/assets/css/dark/authentication/auth-cover.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/assets/css/light/authentication/auth-cover.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/layouts/modern-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>
<body >
<!-- BEGIN LOADER -->
<div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
<!--  END LOADER -->

<div class=" d-flex p-0 m-0  vh-100 ">

    <div class="col-lg-12 col-12  h-100 d-flex   position-relative justify-content-center">
        <div class="w-100 h-100 position-absolute " style="background-image: linear-gradient(-225deg, #231557 0%, #44107A 29%, rgba(255, 19, 97, 0.75) 100%);"></div>
        <div class="card bg-transparent p-0 m-0 rounded-0 col-md-7 col-lg-5 col-sm-9 col-10">
            <div class="card-body rounded-0 h-100 ">

                <div class="row align-items-center p-0 m-0 col-12 ">
                    <div class="col-md-12 mb-3">

                        <h2 class="text-white">Login</h2>
                        <p class="text-white">Enter your email and password to login</p>

                    </div>
                    <form class="rounded-0 row p-0 m-0 col-12  justify-content-center " method="POST" id="registerForm" action="{{ route('login') }}">
                        @csrf
                        <div class=" mb-2 col-md-12">
                            <label for="email" class="form-label text-white">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control bg-white text-black " name="email" value="{{ old('email') }}"  autocomplete="email">
                                @error('email')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class=" mb-2 col-md-12">
                            <label for="password" class="form-label text-white">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control bg-white text-black " name="password"  autocomplete="new-password">
                                @error('password')
                                <span class=" text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>



                        <div class="col-12">
                            <div class="mb-4">
                                <button class="btn btn-primary ">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </form>




                    <div class="col-12 mb-4">
                        <div class="">
                            <div class="seperator">
                                <hr>
                                <div class="seperator-text"> <span>Or continue with</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-12">
                        <div class="mb-4">
                            <button class="btn  btn-social-login w-100 ">
                                <img src="{{asset('assets/src/assets/img/google-gmail.svg')}}" alt="" class="img-fluid">
                                <span class="btn-text-inner">Google</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-sm-4 col-12">
                        <div class="mb-4">
                            <button class="btn  btn-social-login w-100">
                                <img src="{{asset('assets/src/assets/img/github-icon.svg')}}" alt="" class="img-fluid">
                                <span class="btn-text-inner">Github</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-sm-4 col-12">
                        <div class="mb-4">
                            <button class="btn  btn-social-login w-100">
                                <img src="{{asset('assets/src/assets/img/twitter.svg')}}" alt="" class="img-fluid">
                                <span class="btn-text-inner">Twitter</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center">
                            <p class="mb-0 text-white">Dont have account ? <a href="{{route('register')}}" class="text-warning">Register</a></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


</div>
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>
