@extends('layouts.app-blog-create')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/src/plugins/src/filepond/filepond.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}">
    <link href="{{asset('assets/src/plugins/src/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/src/plugins/src/sweetalerts2/sweetalerts2.css')}}">
    <link href="{{asset('assets/src/plugins/css/light/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/plugins/css/dark/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="row my-2">

        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('coach')}}">Coach</a></li>
                <li class="breadcrumb-item"><a href="{{url('coach/category/'.$category->id.'/products')}}">products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create product</li>
            </ol>
        </nav>
        <h4 class="my-3">{!! __('products.addNewProduct') !!}</h4>

        @if(isset($subcategories) &&$subcategories->count() ==0)

            <div class="alert alert-warning" role="alert">
                {!! __('products.youMustAddSubCategories') !!} {{$category->name_en}}
            </div>
        @endif
        @if(isset($brands) &&$brands->count() ==0 )
            <div class="alert alert-warning" role="alert">
                {!! __('products.youMustAddSubBrands') !!}
            </div>
        @endif


        <form id="addProductForm" method="post" class="my-2" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="coach_id" value="{{\Illuminate\Support\Facades\Auth::user()?->id}}">
            <div class="row">


                <div class="my-1 col-md-4 col-12">
                    <label for="name_en">{!! __('products.nameEn') !!}</label>
                    <input type="text" class="form-control" id="name_en" name="name"
                           placeholder="{!! __('products.enterNameEn') !!}">
                </div>
                <div class="my-1 col-md-4 col-12">
                    <label for="name_ar">{!! __('products.nameAr') !!}</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                           placeholder="{!! __('products.enterNameAr') !!}">
                </div>
                <div class="my-1 col-md-4 col-12">
                    <label for="name_ku">{!! __('products.nameKu') !!}</label>
                    <input type="text" class="form-control" id="name_ku" name="name_ku"
                           placeholder="{!! __('products.enterNameKu') !!}">
                </div>
                <div class="my-1 col-md-4 col-12">
                    <label for="description_en">{!! __('products.descriptionEn') !!}</label>
                    <textarea type="text" class="form-control" id="description_en" name="description"
                              placeholder="{!! __('products.enterDescriptionEn') !!}"></textarea>
                </div>
                <div class="my-1 col-md-4 col-12">
                    <label for="description_ar">{!! __('products.descriptionAr') !!}</label>
                    <textarea type="text" class="form-control" id="description_ar" name="description_ar"
                              placeholder="{!! __('products.enterDescriptionAr') !!}"></textarea>
                </div>
                <div class="my-1 col-md-4 col-12">
                    <label for="description_ku">{!! __('products.descriptionKu') !!}</label>
                    <textarea type="text" class="form-control" id="description_ku" name="description_ku"
                              placeholder="{!! __('products.enterDescriptionKu') !!}"></textarea>
                </div>

                <div class="my-1 col-md-4">
                    <label for="quantity">{!! __('products.quantity') !!}</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"
                           placeholder="{!! __('products.enterQuantity') !!}">
                </div>

                <div class="my-1 col-md-4">
                    <label for="price">{!! __('products.price') !!}</label>
                    <input type="text" class="form-control" id="price" name="price"
                           placeholder="{!! __('products.enterPrice') !!}">
                </div>
                <div class="my-1 col-md-4">
                    <label for="discount">{!! __('products.discount') !!}</label>
                    <input type="text" class="form-control" id="discount" name="discount"
                           placeholder="{!! __('products.enterDiscount') !!}">
                </div>
                <div class="my-1 col-md-6 col-12">
                    <label for="images">{!! __('products.images') !!}</label>
                    {{--                    <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>--}}
                    {{--                    <input type="file" id="filepond" name="images[]" accept="image/*"/>--}}
                    <input type="file" id="image" name="images[]"  accept="image/*" required multiple>

                </div>




                <input type="hidden" name="category_id" value="{{$category->id}}">
                @if(isset($subcategories))
                    <div class="my-1 col-md-6 col-12">
                        <label for="subcategory_id">{!! __('products.subCategory') !!}</label>
                        <select class="form-select" id="subcategory_id" name="subcategory_id">
                            <option value="">--{!! __('products.selectSubCategory') !!}--</option>
                            @foreach($subcategories as $category)
                                <option value="{{$category->id}}">{{$category['name_en'.\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale().'']}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if(isset($brands))
                    <div class="my-1 col-md-6 col-12">
                        <label for="brand_id">Brand</label>
                        <select class="form-select" id="brand_id" name="brand_id">
                            <option value="">--{!! __('products.selectBrand') !!}--</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand['name_en'.\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale().'']}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div id="color" class="row my-2">
                    <div class="d-flex flex-row justify-content-between">
                        <label for="" class="col-6">{!! __('products.color') !!}</label>

                        <button onclick="addColor()" type="button" class="btn btn-success">{!! __('products.addColor') !!}</button>
                    </div>
                    <div id="colorsContainer" class="row">
                    </div>
                </div>

                <div id="siezes" class="row my-2">
                    <div class="d-flex flex-row justify-content-between">
                        <label for="" class="col-6">{!! __('products.sizes') !!} </label>

                        <button onclick="addSize()" type="button" class="btn btn-success">{!! __('products.addSize') !!}</button>
                    </div>
                    <div id="sizesContainer" class="row">
                    </div>
                </div>
            </div>
            <div class="my-1">
                <button type="submit" class="btn btn-primary">{!! __('products.add') !!}</button>
            </div>

        </form>
    </div>


@endsection
@section('scripts')

    <script src="{{asset('assets/src/plugins/src/filepond/filepond.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.js')}}"></script>

    <script >
        const inputElement = document.querySelector('#image');
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const pond=FilePond.create(inputElement);
        FilePond.setOptions({
            acceptedFileTypes: ['image/*'],
            allowReorder: true,
            allowMultiple: true,
            allowDrop: true,
            checkValidity: true,
            server: {
                process: '/api/tmp-upload',
                revert:'/api/tmp-delete',
                headers:{
                    'X-CSRF-TOKEN':csrfToken
                }
            }
        });

    </script>


    <script>
        let form = document.querySelector('#addProductForm')

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            let formData = new FormData(form)
            try {
                let response = await fetch('/api/products', {
                    method: 'post',
                    body: formData
                });

                let result = await response.json();

                console.log(result)
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                    })
                    location.reload();
                } else if (result.status === 400) {
                    let message = result.message;
                    let errorMessage = ``;
                    for (const key in message) {
                        errorMessage += `<span class="text-danger d-block"> ${message[key]}</span> \n`
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessage,
                    })
                }

            } catch (error) {
                console.error(error)
            }
        });


        let colorCounter=0
        function addColor() {
            colorCounter++;

            $('#colorsContainer').append(`
                <div class="col-md-2 col-sm-3 col-4 col-lg-1 p-1 my-1" id="color${colorCounter}">
                    <div class="card border overflow-hidden">
                        <div class="card-body p-1 ">
                            <input class="form-control-color w-100  rounded border border-dark" type="color" name="colors[]">
                        </div>
                        <div class="card-footer  col-12 p-1">
                            <button class="btn btn-sm btn-outline-danger w-100" type="button" onclick="deleteColor('color${colorCounter}')"><i class=" fa-light fa-remove "></i></button>
                        </div>
                    </div>
                </div>
            `)
        }
        function deleteColor(color){

            $(`#${color}`).remove()
        }

        let sizeCounter=0
        function addSize() {
            sizeCounter++;

            $('#sizesContainer').append(`
                <div class="col-md-3 col-sm-3 col-4 col-lg-2 p-1 my-1" id="size${sizeCounter}">
                    <div class="card border overflow-hidden">
                        <div class="card-body p-1 ">
                            <input class="form-control w-100  rounded border border-dark" type="text" name="sizes[]">
                        </div>
                        <div class="card-footer  p-1">
                            <button class="btn btn-sm btn-outline-danger w-100" type="button" onclick="deleteColor('size${sizeCounter}')"><i class=" fa-light fa-remove "></i></button>
                        </div>
                    </div>
                </div>
            `)
        }
    </script>
@endsection

