<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="">
                        <img src="{{asset('assets/images/logo/xlogo.png')}}" class="" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="./index.html" class="nav-link"> X Fitness </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="profile-info">
            <div class="user-info">
                <div class="profile-img">
                    <img src="{{asset(Auth::user()->user?->profile_image??'assets/images/logo/xlogo.png')}}" alt="avatar">
                </div>
                <div class="profile-content">
                    <h6 class="">{{Auth::user()->name??'Name'}}</h6>
                    <p class="">Coach</p>
                </div>
            </div>
        </div>

        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="dashboard" data-bs-parent="#accordionExample">
                    <li>
                        <a href="{{url('coach/analytics')}}"> Analytics </a>
                    </li>
                    <li>
                        <a href="{{url('coach/sales')}}"> Sales </a>
                    </li>
                </ul>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>PRODUCTS</span></div>
            </li>

            <li class="menu">
                <a href="{{url('coach/categories')}}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fa-regular fa-square fa-2xs"></i>
                        <span>Categories</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="{{url('coach/brands')}}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fa-regular fa-tags fa-2xs"></i>
                        <span>Brands</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="#products" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fa-light fa-box-open fa-2xs"></i>
                        <span>Products</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="products" data-bs-parent="#accordionExample">
                    <li>
                        <a href="{{url('coach/products')}}"> List </a>
                    </li>
                    <li>
                        <a href="{{url('coach/products/create')}}"> Add </a>
                    </li>
                </ul>
            </li>
            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>COURSES</span></div>
            </li>

            <li class="menu">
                <a href="{{url('coach/videos')}}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fa-regular fa-video fa-2xs"></i>
                        <span>Videos</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="#courses" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fa-light fa-graduation-cap fa-2xs"></i>
                        <span>Courses</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="courses" data-bs-parent="#accordionExample">
                    <li>
                        <a href="{{url('coach/courses')}}"> List </a>
                    </li>
                    <li>
                        <a href="{{url('coach/courses/create')}}"> Add </a>
                    </li>
                </ul>
            </li>

            <hr>
            <li class="menu">
                <a href="{{url('coach/users')}}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fa-regular fa-user fa-2xs"></i>
                        <span>Users</span>
                    </div>
                </a>
            </li>
{{--            <li class="menu">--}}
{{--                <a href="#invoice" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                             stroke-linejoin="round" class="feather feather-dollar-sign">--}}
{{--                            <line x1="12" y1="1" x2="12" y2="23"></line>--}}
{{--                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>--}}
{{--                        </svg>--}}
{{--                        <span>Invoice</span>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                             stroke-linejoin="round" class="feather feather-chevron-right">--}}
{{--                            <polyline points="9 18 15 12 9 6"></polyline>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--                <ul class="collapse submenu list-unstyled" id="invoice" data-bs-parent="#accordionExample">--}}
{{--                    <li>--}}
{{--                        <a href="./app-invoice-list.html"> List </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="./app-invoice-preview.html"> Preview </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="./app-invoice-add.html"> Add </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="./app-invoice-edit.html"> Edit </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

        </ul>

    </nav>

</div>
