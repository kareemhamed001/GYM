@extends('layouts.user.layout')
@section('styles')
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/src/plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
@endsection
@section('content')
    <section class="row">

        <div class="container d-flex flex-wrap justify-content-center my-5 ">
            <h3 class="fw-bold text-capitalize">
                Shopping cart
            </h3>
            @php
                $allCartsTotalPrice=0;
            @endphp
            @foreach($carts as $cart)
                <div class="my-4 col-12 col-sm-12 col-md-12  border-bottom rounded-0 bg-transparent shadow-sm ">
                    <div class="row col-12  no-gutters justify-content-center px-2 px-lg-0">
                        <a href="{{url('product/'.$cart->product->id)}}"
                           class="col-lg-4  overflow-hidden d-flex p-lg-0 pb-3" style="height: 180px">
                            <div class="col-6 col-sm-7 col-md-7 col-lg-8">
                                <img src="{{asset($cart->product->cover_image)}}"
                                     class="card-img rounded-1 img-fluid w-100 h-100 "
                                     style="object-fit: cover" alt="...">
                            </div>

                            <div class="col d-flex flex-column justify-content-center  px-2">
                                <h5 class="card-title fw-bold">{{$cart->product['name_'.$lang]}}</h5>
                                <p class="card-text"><small
                                        class="text-muted">{{$cart->product->category['name_'.$lang]}}</small></p>
                            </div>
                        </a>



                            <div class="col-lg-3 col-12">
                                <div
                                    class="d-flex  align-items-center justify-content-lg-center justify-content-between h-100 col-12 ">
                                    <div class="col h-100 d-flex flex-column justify-content-around align-items-start">
                                        <h6>Price</h6>
                                        <p class=" fs-6">$<span class="text-danger">{{$cart->price}}</span>
                                        </p>
                                    </div>
                                    @if($cart->color_id)
                                        <div
                                            class="col h-100 d-flex flex-column justify-content-around align-items-center">
                                            <h6>Color</h6>
                                            <p class=" fs-6 border p-2 rounded" style="background-color:{{$cart->color?->value}} "><span
                                                    class="" >{{$cart->color?->value}}</span></p>
                                        </div>
                                    @endif
                                    @if($cart->size_id)
                                        <div
                                            class="col h-100 d-flex flex-column justify-content-around align-items-end">
                                            <h6>Size</h6>
                                            <p class=" fs-6"><span
                                                    class="text-danger">{{$cart->size?->value}}</span></p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2 col-12 py-3 d-flex flex-column justify-content-center ">
                                <div class="d-flex flex-column align-items-center justify-content-around h-100">
                                    <h6>Quantity</h6>
                                    <input type="number" name="quantity" placeholder="quantity" class="form-control-sm "
                                           value="{{$cart->quantity}}">
                                </div>
                            </div>
                            <div class="col-lg-3  ">

                                <div
                                    class="d-flex flex-row flex-lg-column align-items-center justify-content-between justify-content-lg-around h-100 px-lg-0">
                                    <h6>Total</h6>
                                    @php
                                        $cartTotal=($cart->price*($cart->discount/100))*$cart->quantity;
                                        $allCartsTotalPrice+=$cartTotal;
                                    @endphp
                                    <p class=" fs-6">$<span
                                            class="text-danger">{{$cartTotal}}</span>
                                    </p>
                                </div>

                            </div>

                    </div>
                </div>

            @endforeach
            <div class="col-12 d-flex justify-content-end">
                <h4 class="fw-bold text-capitalize">
                    Sub Total = $<span class="text-danger">{{$allCartsTotalPrice}}</span>
                </h4>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script src="{{asset('assets/src/plugins/src/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/bootstrap-touchspin/custom-bootstrap-touchspin.js')}}"></script>
    <script>
        $("input[name='quantity']").TouchSpin();
    </script>
@endsection
