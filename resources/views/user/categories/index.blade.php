@extends('layouts.user.layout')
@section('content')
    <section class="container vw-100">

        <h3 class="fw-bold text-capitalize text-center my-5">
            Select a category
        </h3>
        <div class="row">

            @foreach($categories as $category)

                <div class="col-md-4 col-lg-4 col-xl-3 col-sm-6 col-6 my-2 px-md-1 px-1 border-0" style="height: 200px">
                    <a class="card hoverable style-7 border-0 overflow-hidden w-100 h-100" href="{{url('category/'.config('mainCategoriesById.'.$category->id).'/store')}}" >
                        <img src="{{asset($category->cover_image)}}" style="object-fit: cover" class="card-img-top w-100 h-100" alt="...">
                        <div class="card-footer custom">
                            <div class="card-title mb-0">{{$category['name_'.$lang]}}</div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </section>
@endsection
