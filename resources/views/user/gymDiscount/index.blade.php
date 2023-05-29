@extends('layouts.user.layout')
@section('content')

    <section class="container-md vw-100">

        <h3 class="fw-bold text-capitalize text-center my-4">
            {{$category['name_'.$lang]}}
        </h3>
        <div class="row">

            @foreach($gyms as $gym)

                <div class="col-md-6 col-lg-4 col-xl-3 col-sm-6 col-12 my-2 px-md-1 px-1 border-0" style="height: 350px">
                    <a class="card hoverable border-0 overflow-hidden w-100 h-100"
                       href="{{url('/'.config('mainCategoriesById.'.config('mainCategories.GymDiscount.id')),$gym->id)}}">
                        <div class="card-img h-60">
                            <img src="{{asset($gym->cover_image)}}" style="object-fit: cover"
                                 class="card-img-top w-100 h-100" alt="...">
                        </div>
                        <span class="card-body d-flex">
                            <div class="col-8 h-100 d-flex flex-column justify-content-between">
                            <h6 class="card-title mb-0 fw-bold">{{$gym['name_'.$lang]}}</h6>
                                <p>
                                    <i class="fa-light fa-clock"></i>
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s',$gym->open_at)->format('H:i A')}}-
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s',$gym->close_at)->format('H:i A')}}
                                </p>

                            </div>
                            <div class="col-4 h-100 d-flex flex-column justify-content-between align-items-center">
                                <p>Starting price</p>
                                <h5 class="text-danger fw-bold">${{$gym->price}}</h5>
                            </div>
                        </span>

                    </a>
                </div>
            @endforeach

        </div>
    </section>
@endsection
