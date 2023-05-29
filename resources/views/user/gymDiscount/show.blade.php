@extends('layouts.user.layout')
@section('content')

    <section class="container-md my-3">
        <nav class="breadcrumb-style-five" aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item active"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/category/GymDiscount/store')}}">{{config('mainCategories.GymDiscount.name')}}</a></li>
                <li class="breadcrumb-item disabled" aria-current="page">{{$gym['name_'.$lang] }}</li>
            </ol>
        </nav>
    </section>

    <section class="container-md vh-75">

        <img src="{{asset($gym->cover_image)}}" class="w-100 h-100 rounded" style="object-fit: cover" alt="">
    </section>
    <section class="container py-3 d-flex flex-column align-items-center justify-content-center">

        <div class="card col-12">
            <div class="card-body">
                <h5 class="fw-bold">{{$gym['name_'.$lang]}}</h5>
                <div class="d-flex justify-content-between">
                    <p>Starting price</p>
                    <h5 class="fw-bold text-danger">${{$gym->price}}</h5>
                </div>
                <h5 class="fw-bold">Timings</h5>
                <div class="d-flex justify-content-between">
                    <p>Opens at:</p>
                    <h6 class="fw-bold">{{\Carbon\Carbon::create($gym->open_at)->format('H:i A')}}</h6>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Closes at:</p>
                    <h6 class="fw-bold">{{\Carbon\Carbon::create($gym->close_at)->format('H:i A')}}</h6>
                </div>
                <h5 class="fw-bold">Address</h5>
                <p>{{$gym->address}}</p>
                <h5 class="fw-bold">Services</h5>
                <p>{{$gym->address}}</p>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center align-items-center flex-column py-3">
            <button class="btn bg-white border fw-bold col-12 col-md-6 col-lg-4 col-xl-3" onclick="togglePhone('{{$gym->phone_number}}','Phone Number')" id="phone_number">Phone Number</button>
            <button class="btn btn-danger fw-bold text-capitalize my-2 col-12 col-md-6 col-lg-4 col-xl-3">get discount code</button>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function togglePhone(phoneNumber,text){

            let btn=document.getElementById('phone_number')
                if(btn.innerText===text){
                    btn.innerText=phoneNumber
                }else {
                    btn.innerText=text
                }

        }
    </script>

@endsection
