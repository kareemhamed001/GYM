@extends('layouts.user.layout')
@section('content')
    <section class="vh-90 d-md-block d-none position-relative" id="homePageCover">
        <div class="w-100 h-100 bg-dark bg-opacity-25 position-absolute" id="" style="z-index: 0">
        </div>
        <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center" style="z-index: 3">

            <h3 class="text-white col-6 text-center p-5" style="z-index: 3">Welcome to X_Fitness, where we believe that a healthy body and a healthy mind are the keys to a happy and fulfilling life. Our mission is to help you achieve your fitness goals and become the best version of yourself.</h3>
            <form class="col-md-6 col-8" action="" style="z-index: 3">

                <div class="input-group shadow-sm">
                    <input type="text" class="form-control  p-2 fs-5" placeholder="Search">
                    <button class="btn btn-primary px-4"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </form>

        </div>

    </section>
    <section class="vh-100">

    </section>
@endsection
