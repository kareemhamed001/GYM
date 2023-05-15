<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignIn Cover | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/src/assets/img/favicon.ico')}}"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('assets/layouts/modern-light-menu/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('assets/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>


    <link href="{{asset('assets/layouts/modern-light-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/src/assets/css/dark/authentication/auth-cover.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/src/assets/css/light/authentication/auth-cover.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/layouts/modern-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
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
<body>

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

<div class=" d-flex p-0 m-0   ">

    {{--            <div class="col-lg-6 d-lg-flex d-none text-center justify-content-center flex-column   position-relative">--}}


    {{--                    <div class="w-100 h-100 position-absolute " style="background-image: linear-gradient(-225deg, #231557 0%, #44107A 29%, rgba(255, 19, 97, 0.75) 100%);"></div>--}}


    {{--                <div class="auth-cover">--}}

    {{--                    <div class="position-relative">--}}

    {{--                        <img src="{{asset('assets/src/assets/img/dumbel1.svg')}}" alt="auth-img">--}}

    {{--                        <h2 class="mt-5 text-white font-weight-bolder px-2">Join the community of expert developers</h2>--}}
    {{--                        <p class="text-white px-2">It is easy to setup with great customer experience. Start your 7-day free trial</p>--}}
    {{--                    </div>--}}

    {{--                </div>--}}

    {{--            </div>--}}
    <div class="col-lg-12 col-12  h-100 d-flex   position-relative justify-content-center">
        <div class="w-100 h-100 position-absolute "
             style="background-image: linear-gradient(-225deg, #231557 0%, #44107A 29%, rgba(255, 19, 97, 0.75) 100%);"></div>
        <div class="card bg-transparent p-0 m-0 rounded-0 col-md-8 col-lg-6 col-sm-10 col-11">
            <div class="card-body rounded-0  ">

                <div class="row p-0 m-0 col-12 ">
                    <div class="col-md-12 mb-3">

                        <h2>Sign Up</h2>
                        <p>Enter your email and password to register</p>

                    </div>
                    <form class="rounded-0 row p-0 m-0 col-12  justify-content-center " method="POST" id="registerForm"
                          action="{{ route('register') }}">
                        @csrf

                        <div class=" mb-2 col-md-6">
                            <label for="name" class="form-label text-white">{{ __('Name') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control bg-white bg-black" name="name"
                                       value="{{ old('name') }}" autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class=" mb-2 col-md-6">
                            <label for="image" class="form-label text-white">{{ __('Profile Image') }}</label>

                            <div class="col-md-12">
                                <input id="image" type="file" class="form-control bg-white " name="profile_image"
                                       accept="image/*">
                            </div>
                        </div>

                        <div class=" mb-2 col-md-12">
                            <label for="email" class="form-label text-white">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control bg-white " name="email"
                                       value="{{ old('email') }}" autocomplete="email">
                            </div>
                        </div>
                        <div class=" mb-2 col-md-6">
                            <label for="phone_number" class="form-label text-white">{{ __('Phone Number') }}</label>

                            <div class="col-md-12">
                                <input id="phone_number" type="text" class="form-control bg-white " name="phone_number"
                                       value="{{ old('phone_number') }}" autocomplete="phone_number">
                            </div>
                        </div>

                        <div class=" mb-2 col-md-6">
                            <label for="address"
                                   class="form-label text-white">{{ __('Address') }}</label>

                            <div class="col-md-12">
                                <input id="address" type="text" class="form-control bg-white "
                                       name="address" value="{{ old('address') }}" autocomplete="address">

                            </div>
                        </div>
                        <div class=" mb-2 col-md-4">
                            <label for="country" class="form-label text-white">{{ __('Country') }}</label>

                            <div class="col-md-12">
                                <input id="country" type="text" class="form-control bg-white " name="country"
                                       value="{{ old('country') }}" autocomplete="country">
                            </div>
                        </div>
                        <div class=" mb-2 col-md-4">
                            <label for="age"
                                   class="form-label text-white">{{ __('Age') }}</label>

                            <div class="col-md-12">
                                <input id="age" type="number" class="form-control bg-white "
                                       name="age" value="{{ old('age') }}" autocomplete="age">
                            </div>
                        </div>
                        <div class=" mb-2 col-md-4">
                            <label for="gender"
                                   class="form-label text-white">{{ __('Gender') }}</label>

                            <div class="col-md-12">
                                <select name="gender" class="form-control bg-white" type="text" id="gender" onchange="">
                                    <option>--Select Gender--</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="role_as" value="2">

                        <div class=" mb-2 col-md-6">
                            <label for="password" class="form-label text-white">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control bg-white " name="password"
                                       autocomplete="new-password">
                            </div>
                        </div>

                        <div class=" mb-2 col-md-6">
                            <label for="password-confirm"
                                   class="form-label text-white">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control bg-white"
                                       name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <button class="btn btn-primary ">{{ __('Register') }}</button>
                            </div>
                        </div>
                    </form>


                    <div class="col-12 mb-4">
                        <div class="">
                            <div class="seperator">
                                <hr>
                                <div class="seperator-text"><span>Or continue with</span></div>
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
                            <p class="mb-0">Already have an account ? <a href="{{route('login')}}" class="text-warning">Sign
                                    in</a></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


</div>
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showLoader() {
        $('#ajax_loader').show()
    }

    function removeLoader() {
        $('#ajax_loader').hide()
    }

    let form = document.querySelector('#registerForm')
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let formData = new FormData(form)
        try {
            showLoader();
            let response = await fetch('/api/auth/register', {
                method: 'post',
                body: formData,
            });
            console.log(response)

            let result = await response.json();
            removeLoader();

            if (result.status === 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: result.message,
                })
            } else if (result.status === 400) {
                let message = result.message;
                let errorMessage = `<ul>`;
                for (const key in message) {
                    errorMessage += `<li class="text-danger text-start w-100"> ${message[key]}</li> \n`
                }
                errorMessage += `</ul>`;
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: errorMessage,
                })
            }

        } catch (error) {
            console.error(error)
        }
    });
</script>
<!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>
