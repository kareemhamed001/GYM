@extends('layouts.app-blog-create')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/src/stepper/bsStepper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/scrollspyNav.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/css/light/stepper/custom-bsStepper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/scrollspyNav.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/css/dark/stepper/custom-bsStepper.css')}}">
@endsection
@section('content')
{{--    <div class="row my-2">--}}

{{--        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{url('coach')}}">Coach</a></li>--}}
{{--                <li class="breadcrumb-item"><a href="{{url('coach/courses')}}">brands</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">Create course</li>--}}
{{--            </ol>--}}
{{--        </nav>--}}
{{--        <h4 class="my-3">Add course</h4>--}}
{{--        <img id="preview">--}}
{{--        <form id="addcourseForm" class="my-2">--}}
{{--            @csrf--}}
{{--            <input type="hidden" name="coach_id" value="{{\Illuminate\Support\Facades\Auth::user()?->id??1}}">--}}
{{--            <div class="row">--}}
{{--                <div class="my-1 col-md-6">--}}
{{--                    <label for="cover_image">Cover_image</label>--}}
{{--                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">--}}
{{--                </div>--}}
{{--                <div class="my-1 col-md-6">--}}
{{--                    <label for="brand_id">Brand</label>--}}
{{--                    <select  class="form-select" id="brand_id" name="brand_id" >--}}
{{--                        <option value="">--select brand--</option>--}}
{{--                        @foreach(\App\Models\brand::all() as $brand)--}}

{{--                            <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="my-1 col-12">--}}
{{--                    <label for="name_en">Name En</label>--}}
{{--                    <input type="text" class="form-control" id="name_en" name="name"--}}
{{--                           placeholder="course Name In English *">--}}
{{--                </div>--}}
{{--                <div class="my-1 col-md-6">--}}
{{--                    <label for="name_ar">Name Ar</label>--}}
{{--                    <input type="text" class="form-control" id="name_ar" name="name_ar"--}}
{{--                           placeholder="course Name In Arabic *">--}}
{{--                </div>--}}
{{--                <div class="my-1 col-md-6">--}}
{{--                    <label for="name_ku">Name Ku</label>--}}
{{--                    <input type="text" class="form-control" id="name_ku" name="name_ku"--}}
{{--                           placeholder="course Name In Kurdish *">--}}
{{--                </div>--}}
{{--                <div class="my-1 col-12">--}}
{{--                    <label for="description_en">Description En</label>--}}
{{--                    <textarea type="text" class="form-control" id="description_en" name="description"--}}
{{--                              placeholder="course Description In English *"></textarea>--}}
{{--                </div>--}}
{{--                <div class="my-1 col-md-6">--}}
{{--                    <label for="description_ar">Description Ar</label>--}}
{{--                    <textarea type="text" class="form-control" id="description_ar" name="description_ar"--}}
{{--                              placeholder="course Description In Arabic *"></textarea>--}}
{{--                </div>--}}
{{--                <div class="my-1 col-md-6">--}}
{{--                    <label for="description_ku">Description Ku</label>--}}
{{--                    <textarea type="text" class="form-control" id="description_ku" name="description_ku"--}}
{{--                              placeholder="course Description In Kurdish *"></textarea>--}}
{{--                </div>--}}
{{--                <div class="my-1 col-6">--}}
{{--                    <label for="quantity">Quantity</label>--}}
{{--                    <input type="text" class="form-control" id="quantity" name="quantity"--}}
{{--                           placeholder="course Description In Kurdish *">--}}
{{--                </div>--}}
{{--                <div class="my-1 col-6">--}}
{{--                    <label for="unit">Unit(EX.KG)</label>--}}
{{--                    <input type="text" class="form-control" id="unit" name="unit"--}}
{{--                           placeholder="Unit of course *">--}}
{{--                </div>--}}
{{--                <div class="my-1 col-6">--}}
{{--                    <label for="price">Price</label>--}}
{{--                    <input type="text" class="form-control" id="price" name="price"--}}
{{--                           placeholder="Price *">--}}
{{--                </div>--}}
{{--                <div class="my-1 col-6">--}}
{{--                    <label for="discount">Discount</label>--}}
{{--                    <input type="text" class="form-control" id="discount" name="discount"--}}
{{--                           placeholder="Discount in percent *">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="my-1">--}}
{{--                <button type="submit" class="btn btn-primary">Add</button>--}}
{{--            </div>--}}

{{--        </form>--}}
{{--    </div>--}}

    <div class="row layout-top-spacing" id="cancel-row">

        <div id="wizard_Default" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Default</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="bs-stepper stepper-form-one">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#defaultStep-one">
                                <button type="button" class="step-trigger" role="tab" >
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Course Details</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#defaultStep-two">
                                <button type="button" class="step-trigger" role="tab"  >
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Step Two</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#defaultStep-three">
                                <button type="button" class="step-trigger" role="tab"  >
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Step Three</span>
                                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <div id="defaultStep-one" class="content" role="tabpanel">
                                <form>
                                    <div class="form-group mb-4">
                                        <label for="defaultForm-name">Name</label>
                                        <input type="text" class="form-control" id="defaultForm-name">
                                    </div>
                                </form>

                                <div class="button-action mt-5">
                                    <button class="btn btn-secondary btn-prev me-3" disabled>Prev</button>
                                    <button class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>
                            <div id="defaultStep-two" class="content" role="tabpanel">
                                <form>
                                    <div class="form-group mb-4">
                                        <label for="defaultEmailAddress">Email Address</label>
                                        <input type="email" class="form-control" id="defaultEmailAddress">
                                    </div>
                                </form>

                                <div class="button-action mt-5">
                                    <button class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>
                            <div id="defaultStep-three" class="content" role="tabpanel" >
                                <form class="row g-3">
                                    <div class="col-12">
                                        <label for="defaultInputAddress" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="defaultInputAddress" placeholder="1234 Main St">
                                    </div>
                                    <div class="col-12">
                                        <label for="defaultInputAddress2" class="form-label">Address 2</label>
                                        <input type="text" class="form-control" id="defaultInputAddress2" placeholder="Apartment, studio, or floor">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="defaultInputCity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="defaultInputCity">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="defaultInputState" class="form-label">State</label>
                                        <select id="defaultInputState" class="form-select">
                                            <option selected="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="defaultInputZip" class="form-label">Zip</label>
                                        <input type="text" class="form-control" id="defaultInputZip">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="defaultGridCheck">
                                            <label class="form-check-label" for="defaultGridCheck">
                                                Check me out
                                            </label>
                                        </div>
                                    </div>
                                </form>

                                <div class="button-action mt-3">
                                    <button class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button class="btn btn-success me-3">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/src/plugins/src/stepper/bsStepper.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/stepper/custom-bsStepper.min.js')}}"></script>
    <script>
        let form= document.querySelector('#addcourseForm')

        form.addEventListener('submit',async (e)=>{
            e.preventDefault();
            let formData=new FormData(form)
            try {
                let response =await fetch('/api/courses',{
                    method:'post',
                    body:formData
                });

                let result=await response.json();

                console.log(result)
                if (result.status===200){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                    })
                }else if(result.status===400){
                    let message = result.message;
                    let errorMessage = ``;
                    for (const key in message) {
                        errorMessage +=`<span class="text-danger d-block"> ${message[key]}</span> \n`
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessage,
                    })
                }

            }catch(error){
                console.error(error)
            }
        });

        function previewImage(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function() {
                    const preview = document.getElementById("preview");
                    preview.src = reader.result;
                });

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
