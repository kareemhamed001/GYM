@extends('layouts.user.layout')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/src/glightbox/glightbox.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/src/splide/splide.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/components/tabs.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/apps/ecommerce-details.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/components/tabs.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/apps/ecommerce-details.css')}}">
@endsection
@section('content')
    <div class="container-lg layout-top-spacing ">

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4 ">

            <div class="widget-content widget-content-area br-8 col-12 ">

                <div class="row justify-content-center">
                    <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-7 col-sm-9 col-12 pe-3">
                        <!-- Swiper -->
                        <div id="main-slider" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">


                                        <li class="splide__slide">
                                            <a href="{{asset($product->cover_image)}}" class="glightbox">
                                                <img style="object-fit: scale-down"  alt="ecommerce" src="{{asset($product->cover_image)}}">
                                            </a>
                                        </li>
                                    @foreach($product->images as $image)
                                        <li class="splide__slide">
                                            <a href="{{asset($image?->image??'')}}" class="glightbox">
                                                <img  style="object-fit: scale-down" alt="ecommerce" src="{{asset($image?->image??'' )}}">
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <div id="thumbnail-slider" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li class="splide__slide"><img style="object-fit: scale-down" alt="ecommerce" src="{{asset($product->cover_image)}}"></li>

                                @foreach($product->images as $image)
                                        <li class="splide__slide"><img style="object-fit: scale-down" alt="ecommerce" src="{{asset($image?->image??'')}}"></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="col-xxl-4 col-xl-5 col-lg-12 col-md-12 col-12 mt-xl-0 mt-5 align-self-center">

                        <div class="product-details-content">

                            <span class="badge badge-light-danger mb-3">{{$product->discount}}% Sale off</span>

                            <h3 class="product-title mb-0">{{$product->name}}</h3>

                            <div class="review mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span class="rating-score">4.88 <span class="rating-count">(200 Reviews)</span></span>
                            </div>

                            <div class="row">

                                <div class="col-md-9 col-sm-9 col-9">

                                    <div class="pricing">

                                        <span class="discounted-price">${{$product->price * ($product->discount/100) }}</span>
                                        <span class="regular-price">${{$product->price}}</span>

                                    </div>

                                </div>
                                <div class="col-md-3 col-sm-3 col-3 text-end">
                                    <div class="product-share">
                                        <button class="btn btn-light-success btn-icon btn-rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <hr class="mb-4">
                            <div class="row quantity-selector mb-4">
                                <div class="col-xl-6 col-lg-6 col-sm-6 mt-sm-3">Quantity</div>
                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                    <input id="quantityInput" type="text" value="1" name="demo1">
                                    @if($product->quantity<10)
                                        <p class="text-danger product-helpers text-end mt-2">Low Stock</p>
                                    @endif
                                </div>
                            </div>

                            <hr class="mb-5 mt-4">

                            <div class="action-button text-center">

                                <div class="row">

                                    <div class="col-xxl-7 col-xl-7 col-sm-6 mb-sm-0 mb-3">
                                        <button onclick="addToCart({{$product->id}},{{Auth::user()->id??1}},{{$product->price}},{{$product->discount}})" class="btn btn-primary w-100 btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> <span class="btn-text-inner">Add To Cart</span></button>
                                    </div>

                                    <div class="col-xxl-5 col-xl-5 col-sm-6">
                                        <button class="btn btn-success w-100 btn-lg">Buy Now</button>
                                    </div>

                                </div>

                            </div>

                            <div class="secure-info mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                <p>Safe and Secure Payments. Easy returns. 100% Authentic products.</p>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

            <div class="widget-content widget-content-area br-8">

                <div class="production-descriptions simple-pills">

                    <div class="pro-des-content">

                        <div class="row">
                            <div class="col-xxl-6 col-xl-8 col-lg-9 col-md-9 col-sm-12 mx-auto">
                                <div class="product-reviews mb-5">

                                    <div class="row">
                                        <div class="col-sm-6 align-self-center">
                                            <div class="reviews">
                                                <h1 class="mb-0">4.88</h1>
                                                <span>(200 reviews)</span>
                                                <div class="stars mt-3 mb-sm-0 mb-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star empty-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                            <div class="row review-progress mb-sm-1 mb-3">
                                                <div class="col-sm-4">
                                                    <p>5 Star</p>
                                                </div>
                                                <div class="col-sm-8 align-self-center">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row review-progress mb-sm-1 mb-3">
                                                <div class="col-sm-4">
                                                    <p>4 Star</p>
                                                </div>
                                                <div class="col-sm-8 align-self-center">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row review-progress mb-sm-1 mb-3">
                                                <div class="col-sm-4">
                                                    <p>3 Star</p>
                                                </div>
                                                <div class="col-sm-8 align-self-center">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row review-progress mb-sm-1 mb-3">
                                                <div class="col-sm-4">
                                                    <p>2 Star</p>
                                                </div>
                                                <div class="col-sm-8 align-self-center">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row review-progress mb-sm-1 mb-3">
                                                <div class="col-sm-4">
                                                    <p>1 Star</p>
                                                </div>
                                                <div class="col-sm-8 align-self-center">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

            <div class="widget-content widget-content-area br-8    d-flex flex-row flex-nowrap overflow-auto">

                    @foreach($relatedProducts as $related)
                        <div class="col-md-6 col-lg-4 col-xxl-2 col-6 px-md-1 px-1">

                            <a class="card  style-6  text-decoration-none rounded-3 overflow-hidden" style="height: 300px" href="{{url('/product',$related->id)}}">

                                @if($related->discount>0)
                                    <span class="badge badge-danger d-block">
                                {{$product->discount}}% OFF
                            </span>
                                @endif

                                <img src="{{asset($related->cover_image)}}" class="card-img-top h-60 w-100" style="object-fit: cover" alt="...">
                                <div class="card-footer h-40">
                                    <div class="row ">
                                        <div class="col-12 mb-4">
                                            <b class="text-dark">{{$related->name}}</b>
                                            <div class="text-muted card-subtitle fs-6 mb-0">{{$related->brand->name}}</div>
                                        </div>

                                        <div class="col-12 text-end">
                                            <div class="pricing d-flex justify-content-end">
                                                <p class="text-success mb-0 me-2">
                                                    ${{$related->price * ($related->discount/100) }}</p>
                                                <p class="mb-0 line-through">
                                                    <del>${{$related->price}}</del>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach


            </div>

        </div>
    </div>
@endsection
@section('scripts')

    <script>
       async function addToCart(productId,userId,price,discount){
            try{

                let quantity=parseInt(document.getElementById('quantityInput').value);
                if ( quantity===0){
                    throw Error('Quantity should be at least 1')
                }

                let totalPrice=quantity * (price*(discount/100) )
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const data = {
                    'user_id':userId,
                    'supplement_id':productId,
                    'number':quantity,
                    'discount':discount,
                    'price':totalPrice
                };

                $.ajax({
                    url: '/api/carts',
                    method: 'post',
                    data: data,
                    success: function (response) {
                        console.log(response)
                        Swal.fire({
                            icon:'success',
                            title:'Success',
                            text:'Product is added successfully to the cart'
                        });
                    }
                    ,error:function (error){
                        console.log(error)
                        Swal.fire({
                            icon:'error',
                            title:'Error',
                            text:error
                        });
                    }
                })

            }catch (error){
                console.log(error)
                Swal.fire({
                    icon:'error',
                    title:'Error',
                    text:error
                });
            }
        }
    </script>
    <script src="{{asset('assets/src/plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/glightbox/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/splide/splide.min.js')}}"></script>
    <script src="{{asset('assets/src/assets/js/apps/ecommerce-details.js')}}"></script>
@endsection
