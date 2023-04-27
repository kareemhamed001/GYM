@extends('layouts.user.layout')
@section('content')

    <div class="container my-3 ">
        <h2 class="text-center">Coaches</h2>
        <div class="row my-4">
            @foreach($coaches as $coach)
                <div class="col-md-3 my-2">
                    <div class="card shadow-sm border-0">

                        <div class="card-image">
                            <img class="img-fluid rounded" src="{{asset($coach->user->profile_image)}}" alt="">
                        </div>
                        <div class="card-body">
                            <div class="">
                                <h6 class="text-center">{{$coach->nick_name}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$coaches->links()}}
        </div>
    </div>
@endsection
