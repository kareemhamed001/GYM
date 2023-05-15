
<nav class="header navbar navbar-expand-sm expand-header position-sticky sticky-top py-3 navbar-light bg-dark shadow-sm">
    <div class="container-md d-flex align-items-center justify-content-end ">
        <a class="fs-4 fw-bold text-black col-md-2 col-lg-1 col-sm-3 col-10 " href="{{url('/')}}"><span class="text-danger">X_</span>Fitness</a>
        <button class="navbar-toggler col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto d-flex align-items-center ">
                <li class="nav-item active-link ">
                    <a class="nav-link text-white" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{url('coaches')}}">Coaches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{url('store')}}">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">My plans</a>
                </li>
                <li class="nav-item theme-toggle-item">
                    <a href="javascript:void(0);" class="nav-link text-white theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon dark-mode"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun light-mode"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                    </a>
                </li>

                <li class="dropdown show ">
                    <a class=" dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset(Auth::user())}}" alt="">
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @if(Auth::check()&& Auth::user()?->role_as==1)
                            <a class="dropdown-item" href="{{url('/coach')}}">Dashboard</a>
                        @endif

                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="{{asset(Auth::user()?->profile_image??'assets/images/logo/xlogo.png')}}"
                                     class="rounded-circle">
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    &#x1F44B;
                                </div>
                                <div class="media-body">
                                    <h5>{{Auth::user()->name??'Name'}}</h5>
                                    <p>Coach</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="user-profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="app-mailbox.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-inbox">
                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                    <path
                                        d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                </svg>
                                <span>Inbox</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="auth-boxed-lockscreen.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <span>Lock Screen</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            {{--                        <a href="auth-boxed-signin.html">--}}
                            {{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                            {{--                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                            {{--                                 stroke-linejoin="round" class="feather feather-log-out">--}}
                            {{--                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>--}}
                            {{--                                <polyline points="16 17 21 12 16 7"></polyline>--}}
                            {{--                                <line x1="21" y1="12" x2="9" y2="12"></line>--}}
                            {{--                            </svg>--}}
                            {{--                            <form action="{{ route('logout') }}" method="POST">--}}
                            {{--                                @csrf--}}
                            {{--                                <button class="" type="submit">Logout</button>--}}
                            {{--                            </form>--}}
                            {{--                        </a>--}}
                        </div>
                    </div>

                </li>
            </ul>

        </div>
        <ul class="navbar-nav  ">

{{--                <a class="nav-link text-white" href="{{url('/profile')}}"><i class="fa-light fa-user fa-2x"></i></a>--}}


        </ul>
    </div>
</nav>

