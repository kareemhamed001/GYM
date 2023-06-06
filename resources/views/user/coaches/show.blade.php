@extends('layouts.user.layout')
@section('content')

    <div class="container pt-4">
        <h3 class="text-center  fw-bold">Information</h3>

        <div class="row py-4 justify-content-center">
            <div class="col-md-10">
                <div class="card mb-3 p-md-4 p-1 shadow border-0 rounded" >
                    <div class="row g-0">
                        <div class="col-6">
                            <img src="{{asset($coach->user->profile_image)}}" class="img-fluid rounded" alt="{{$coach->nick_name}}">

                        </div>
                        <div class="col-6 px-md-4 ">
                            <div class="card-body">
                                <label class="text-muted">Name</label>
                                <h5 class="card-title">{{$coach->nick_name}}</h5>
                                <label class="text-muted">Age</label>
                                <h5 class="card-title">{{$coach->user->age}}</h5>
                                <label class="text-muted">Experience</label>
                                <h5 class="card-title">{{$coach->experience}} Years</h5>



                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="d-flex justify-content-center align-items-center flex-column ">
            <button class="btn btn-danger text-capitalize my-2 col-md-2 col-8 " >Make A meal plan</button>
            <button class="btn btn-danger text-capitalize my-2 col-md-2 col-8" >Make A workout plan</button>

        </div>
    </div>
@endsection
