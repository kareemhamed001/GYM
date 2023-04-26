@extends('layouts.app-blog-create')
@section('styles')
    <link href="{{asset('assets/src/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/widgets/modules-widgets.css')}}">
    <link href="{{asset('assets/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/widgets/modules-widgets.css')}}">
    <link href="{{asset('assets/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row my-2">
        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
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
        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
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
        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
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
        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
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
        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
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
        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
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
        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
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
    </div>

@endsection
@section('scripts')

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

            console.log(result.data.time)
            let time=new Date(result.data.time);
            $('.time-field').append(time.getHours()+':'+time.getMinutes()+':'+time.getSeconds())
            $('#users-body').html(result.data.users)
            $('#coaches-body').html(result.data.coaches)
            $('#products-body').html(result.data.products)
            $('#brands-body').html(result.data.brands)
            $('#categories-body').html(result.data.categories)
            $('#courses-body').html(result.data.courses)
            $('#videos-body').html(result.data.videos)

        }
    </script>
@endsection



