@extends('layouts.user.layout')
@section('content')

    <div class="container-fluid my-3 ">
        <h2 class="text-center">Coaches</h2>
        <div class="row my-4">
            @foreach($coaches as $coach)
                <div class="col-md-4 col-lg-3 col-6 my-2">
{{--                    <div class="card position-relative shadow-sm hoverable border-0">--}}
{{--                        <a class="text-decoration-none text-black" href="{{url('/coaches',$coach->id)}}">--}}
{{--                            <img class="img-fluid rounded" src="{{asset($coach->user->profile_image)}}" alt="">--}}
{{--                            <div class="card-footer custom">--}}

{{--                                <div class="">--}}

{{--                                    <h5 class="card-title mb-0">{{$coach->nick_name}}</h5>--}}
{{--                                    <p class="card-text">Coach</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}

                    <a class="card hoverable style-7" href="{{url('/coaches',$coach->id)}}" >
                        <img src="{{asset($coach->user->profile_image)}}" class="card-img-top" alt="...">
                        <div class="card-footer">
                            <div class="card-title mb-0">{{$coach->nick_name}}</div>
                            <p class="card-text">Coach</p>
                        </div>
                    </a>
                </div>
            @endforeach
            {{$coaches->links()}}
        </div>
    </div>


@endsection
