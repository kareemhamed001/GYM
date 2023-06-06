<nav
    class="header navbar navbar-expand-sm  expand-header position-sticky sticky-top py-3 navbar-dark text-dark bg-light shadow-sm">
    <div class="container-md  ">
        <a class="fs-4 fw-bold text-black fw-bold col-md-2 col-lg-1 col-sm-3 col-10 " href="{{url('/')}}"><span
                class="text-danger">X_</span>Fitness</a>
        <button class="navbar-toggler bg-dark " type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse d-lg-flex justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex ">
                <li class="nav-item active-link ">
                    <a class="nav-link text-black fw-bold" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item active-link ">
                    <a class="nav-link text-black fw-bold" href="{{url('/categories')}}">Categories</a>
                </li>
            </ul>

            <ul class="navbar-nav d-flex " id="navbarSupportedContent">
                <ul class=" d-flex align-items-center justify-content-center col">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                        <a class="nav-item mx-2 text-black" rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $localeCode }}
                        </a>

                    @endforeach
                </ul>




                <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle " type="button" id="dropdownMenuButton"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar"
                                     src="{{asset(Auth::user()?->profile_image??'assets/images/logo/xlogo.png')}}"
                                     class="rounded-circle">
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                        <a class="dropdown-item " href="javascript:void(0)">

                            <h6 class="text-break">{{Auth::user()?->name??'Name'}}</h6>
                            <p class="text-muted">@if(Auth::check()&&Auth::user()->role_as==1)
                                    Coach
                                @else
                                    User
                                @endif</p>

                        </a>


                        @if(Auth::check()&&Auth::user()->role_as==1)
                            <a class="dropdown-item d-flex align-items-center" href="{{url('/coach')}}">

                                <i class="fa-light fa-dashboard"></i>
                                <span>Dashboard</span>

                            </a>
                        @endif


                        <a class="dropdown-item d-flex align-items-center" href="{{url('user/cart')}}">
                            <i class="fa-light fa-shopping-cart"></i>
                            <span>Cart</span>
                        </a>

                        <a class="dropdown-item d-flex align-items-center" href="{{url('user/profile')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>Profile</span>
                        </a>



                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>


                    </div>

                </li>

                <li class="nav-item theme-toggle-item ">
                    <a href="javascript:void(0);" class="nav-link text-black fw-bold theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-moon dark-mode">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-sun light-mode">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </a>
                </li>
            </ul>

        </div>

    </div>
</nav>



