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
            </ul>

        </div>
        <ul class="navbar-nav  ">

{{--                <a class="nav-link text-white" href="{{url('/profile')}}"><i class="fa-light fa-user fa-2x"></i></a>--}}


        </ul>
    </div>
</nav>

