@extends('layouts.app-blog-create')
@section('styles')
    <link href="{{asset('assets/src/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/widgets/modules-widgets.css')}}">
    <link href="{{asset('assets/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/widgets/modules-widgets.css')}}">
    <link href="{{asset('assets/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/plugins/css/light/apex/custom-apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/plugins/css/dark/apex/custom-apexcharts.css')}}" rel="stylesheet" type="text/css">

@endsection
@section('content')
    <div class="row my-2">
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-user text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Users</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="users-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-dumbbell text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Coaches</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="coaches-body"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-box-open text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Products</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="products-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-tag text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Brands</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="brands-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-square text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Categories</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="categories-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-graduation-cap text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Courses</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="courses-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-video text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Videos</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="videos-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-bell text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Subscriptions</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="subscriptions-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-dollar-sign text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Total Sales</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="sales-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


        <div class="row justify-content-center " id="cancel-row">
            <div id="chartArea" class="col-xl-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div id="s-line-area" class=""></div>
                    </div>
                </div>
            </div>
            <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div id="s-line-area-coaches" class=""></div>
                    </div>
                </div>
            </div>
            <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div id="s-line-area-products" class=""></div>
                    </div>
                </div>
            </div>
            <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div id="s-line-area-brands" class=""></div>
                    </div>
                </div>
            </div>
            <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div id="s-line-area-categories" class=""></div>
                    </div>
                </div>
            </div>
            <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div id="s-line-area-courses" class=""></div>
                    </div>
                </div>
            </div>
            <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div id="s-line-area-videos" class=""></div>
                    </div>
                </div>
            </div>
        </div>

{{--    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">--}}
{{--        <div class="widget widget-table-three">--}}

{{--            <div class="widget-heading">--}}
{{--                <h5 class="">Top Selling Product</h5>--}}
{{--            </div>--}}

{{--            <div class="widget-content">--}}
{{--                <div class="table-responsive">--}}
{{--                    <table class="table table-scroll">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th><div class="th-content">Product</div></th>--}}
{{--                            <th><div class="th-content th-heading">Price</div></th>--}}
{{--                            <th><div class="th-content th-heading">Discount</div></th>--}}
{{--                            <th><div class="th-content">Sold</div></th>--}}
{{--                            <th><div class="th-content">Source</div></th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td><div class="td-content product-name"><img src="../src/assets/img/product-headphones.jpg" alt="product"><div class="align-self-center"><p class="prd-name">Headphone</p><p class="prd-category text-primary">Digital</p></div></div></td>--}}
{{--                            <td><div class="td-content"><span class="pricing">$168.09</span></div></td>--}}
{{--                            <td><div class="td-content"><span class="discount-pricing">$60.09</span></div></td>--}}
{{--                            <td><div class="td-content">170</div></td>--}}
{{--                            <td><div class="td-content"><a href="javascript:void(0);" class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-danger feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg> Direct</a></div></td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td><div class="td-content product-name"><img src="../src/assets/img/product-shoes.jpg" alt="product"><div class="align-self-center"><p class="prd-name">Shoes</p><p class="prd-category text-warning">Faishon</p></div></div></td>--}}
{{--                            <td><div class="td-content"><span class="pricing">$108.09</span></div></td>--}}
{{--                            <td><div class="td-content"><span class="discount-pricing">$47.09</span></div></td>--}}
{{--                            <td><div class="td-content">130</div></td>--}}
{{--                            <td><div class="td-content"><a href="javascript:void(0);" class="text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg> Google</a></div></td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td><div class="td-content product-name"><img src="../src/assets/img/product-watch.jpg" alt="product"><div class="align-self-center"><p class="prd-name">Watch</p><p class="prd-category text-danger">Accessories</p></div></div></td>--}}
{{--                            <td><div class="td-content"><span class="pricing">$88.00</span></div></td>--}}
{{--                            <td><div class="td-content"><span class="discount-pricing">$20.00</span></div></td>--}}
{{--                            <td><div class="td-content">66</div></td>--}}
{{--                            <td><div class="td-content"><a href="javascript:void(0);" class="text-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-warning feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg> Ads</a></div></td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td><div class="td-content product-name"><img src="../src/assets/img/product-laptop.jpg" alt="product"><div class="align-self-center"><p class="prd-name">Laptop</p><p class="prd-category text-primary">Digital</p></div></div></td>--}}
{{--                            <td><div class="td-content"><span class="pricing">$110.00</span></div></td>--}}
{{--                            <td><div class="td-content"><span class="discount-pricing">$33.00</span></div></td>--}}
{{--                            <td><div class="td-content">35</div></td>--}}
{{--                            <td><div class="td-content"><a href="javascript:void(0);" class="text-info"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-info feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg> Email</a></div></td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td><div class="td-content product-name"><img src="../src/assets/img/product-camera.jpg" alt="product"><div class="align-self-center"><p class="prd-name">Camera</p><p class="prd-category text-primary">Digital</p></div></div></td>--}}
{{--                            <td><div class="td-content"><span class="pricing">$126.04</span></div></td>--}}
{{--                            <td><div class="td-content"><span class="discount-pricing">$26.04</span></div></td>--}}
{{--                            <td><div class="td-content">30</div></td>--}}
{{--                            <td><div class="td-content"><a href="javascript:void(0);" class="text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-secondary feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg> Referral</a></div></td>--}}
{{--                        </tr>--}}


{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
@section('scripts')
    <script src="{{asset('assets/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/apex/custom-apexcharts.js')}}"></script>
    <script>

        try {
            getDashBoard()

        }catch (error){

        }

        async function getDashBoard(){
            let response=await fetch('/api/statistics',{
                method:'GET'
            })
            let result=await response.json();


            let time=new Date(result.data.time);
            $('.time-field').append(time.getHours()+':'+time.getMinutes()+':'+time.getSeconds())
            $('#users-body').html(result.data.users)
            $('#coaches-body').html(result.data.coaches)
            $('#products-body').html(result.data.products)
            $('#brands-body').html(result.data.brands)
            $('#categories-body').html(result.data.categories)
            $('#courses-body').html(result.data.courses)
            $('#videos-body').html(result.data.videos)
            $('#subscriptions-body').html(result.data.subscriptions)
            $('#sales-body').html(result.data.sales+' $')

        }
    </script>
@endsection



