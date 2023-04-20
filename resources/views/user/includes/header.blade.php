<!DOCTYPE html>
<html lang="">
<head>

    <title>X_Fitness</title>
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky sticky-top py-3">
    <div class="container-md">


        <a class="navbar-brand fw-bold" href="#"><span class="text-danger">X_</span>Fitness</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active-link">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Coaches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My plans</a>
                </li>

            </ul>

        </div>
    </div>
</nav>


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

<section class="vh-100 ">
</section>

<script src="{{asset('assets/js/font-awesome/all.min.js')}}"></script>
<script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
