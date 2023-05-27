@extends('layouts.user.layout')

@section('content')

    <div class="my-3 ">

        <div class="row px-3">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex container-fluid flex-row justify-content-between mb-3">
            <div class="col-6">

                <h4>Brands</h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button class="btn btn-sm btn-primary">Show All Brands</button>
            </div>

        </div>


        <div class="container-fluid  ms-2 d-flex flex-row flex-nowrap overflow-auto" id="brands-scroll">
            @foreach($brands as $brand)
                <div class="col-md-2 col-lg-2 col-sm-4 col-6 my-2 px-md-1 px-1 border-0">
                    <a class="card hoverable style-7 border-0 overflow-hidden" href="{{route('user.store',['brand'=>$brand->id])}}" >
                        <img src="{{asset($brand->cover_image)}}" class="card-img-top" alt="...">
                        <div class="card-footer custom">
                            <div class="card-title mb-0">{{$brand->name}}</div>

                        </div>
                    </a>
                </div>
            @endforeach


        </div>
    </div>

    <div class=" my-3 ">
        <div class="d-flex container-fluid flex-row justify-content-between my-3">
            <div class="col-6">
                <h4>Products</h4>
            </div>

        </div>


        <div class="container-fluid   d-flex flex-wrap">
            @foreach($products as $product)
                <div class="col-md-6 col-lg-4 col-xxl-2 col-6 my-1 px-md-1 px-1">

                    <a class="card hoverable style-6  mb-md-0 mb-4 text-decoration-none rounded-3 overflow-hidden" style="height: 280px" href="{{url('/product',$product->id)}}">

                        @if($product->discount>0)
                            <span class="badge badge-danger d-block">
                                {{$product->discount}}% OFF
                            </span>
                        @endif

                        <img src="{{asset($product->cover_image)}}" class="card-img-top h-60 w-100" style="object-fit: cover" alt="...">
                        <div class="card-footer h-40">
                            <div class="row ">
                                <div class="col-12 mb-4">
                                    <b class="text-dark">{{$product->name}}</b>
                                    <div class="text-muted card-subtitle fs-6 mb-0">{{$product->brand?->name}}</div>
                                </div>

                                <div class="col-12 text-end">
                                    <div class="pricing d-flex justify-content-end">
                                        <p class="text-success mb-0 me-2">
                                            ${{$product->price * ($product->discount/100) }}</p>
                                        <p class="mb-0 line-through">
                                            <del>${{$product->price}}</del>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
        {{$products->links()}}
    </div>

@endsection
