@extends('layouts.user.layout')
@section('styles')
    <link href="{{asset('assets/srcassets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/srcassets/css/light/components/carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/srcassets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/srcassets/css/dark/components/carousel.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <section class="w-100 vh-75 bg-dark">
        <div id="carouselExampleControls" class="carousel slide w-100 h-100" data-bs-ride="carousel">
            <div class="carousel-inner w-100 h-100">
                <div class="carousel-item active w-100 h-100">
                    <img class="d-block w-100 h-100" style="object-fit: cover" src="{{asset('assets/images/a1hb8spI4oXYby3XNHorT1IvAZjh3P2B3dlnkOKU.jpg')}}" alt="First slide">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img class="d-block w-100 h-100" style="object-fit: cover" src="{{asset('assets/images/b3jy9I2G1CSwaQUkDe9oAJlK7WXKptXw2V3PVRoT.jpg')}}" alt="First slide">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img class="d-block w-100 h-100" style="object-fit: cover" src="{{asset('assets/images/6TaTnUOxZ5JTfqFmCc0WzLeaoWect8sljZgFoRBR.jpg')}}" alt="First slide">
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>
    <section class="container py-4">

        <h3 class="fw-bold text-capitalize">
            Categories
        </h3>
        <div class="row">

            @foreach($categories as $category)

                    <div class="col-md-4 col-lg-3 col-sm-6 col-6 my-2 px-md-1 px-1 border-0" style="height: 200px">
                        <a class="card hoverable style-7 border-0 overflow-hidden w-100 h-100" href="{{url($category->id==config('mainCategories.MusclesVideos.id')?'category/'.config('mainCategoriesById.8'):'category/'.config('mainCategoriesById.'.$category->id))}}" >
                            <img src="{{asset($category->cover_image)}}" style="object-fit: cover" class="card-img-top w-100 h-100" alt="...">
                            <div class="card-footer custom">
                                <div class="card-title mb-0">{{$category['name_'.$lang]}}</div>
                            </div>
                        </a>
                    </div>
            @endforeach

        </div>
    </section>

    <section class="container py-4">

        <h3 class="fw-bold text-capitalize">
            Latest Products
        </h3>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-6 col-lg-4 col-xxl-3 col-6 my-1 px-md-1 px-1">

                    <a class="card hoverable style-6  mb-md-0 mb-4 text-decoration-none rounded-3 overflow-hidden"
                       style="height: 280px" href="{{url('/product',$product->id)}}">

                        @if($product->discount>0)
                            <span class="badge badge-danger d-block">
                                {{$product->discount}}% OFF
                            </span>
                        @endif

                        <img src="{{asset($product->cover_image)}}" class="card-img-top h-60 w-100"
                             style="object-fit: cover" alt="...">
                        <div class="card-footer h-40">
                            <div class="row ">
                                <div class="col-12 mb-4">
                                    <b class="text-dark">{{$product['name_'.$lang]}}</b>
                                    <div
                                        class="text-muted card-subtitle fs-6 mb-0">{{$product->brand?$product->brand['name_'.$lang]:$product->category['name_'.$lang]}}</div>
                                </div>

                                <div class="col-12 text-end">
                                    <div class="pricing d-flex justify-content-end">

                                        <p class="text-success mb-0 me-2">
                                            ${{$product->price-($product->price * ($product->discount/100)) }}
                                        </p>
                                        @if($product->discount)
                                            <p class="mb-0 line-through">
                                                <del>${{$product->price}}</del>
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </section>
@endsection
