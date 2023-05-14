@extends('layouts.app-blog-create')
@section('content')
    <div class="row my-2">

        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('coach')}}">Coach</a></li>
                <li class="breadcrumb-item"><a href="{{url('coach/category/'.$category->id.'/products')}}">products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create product</li>
            </ol>
        </nav>
        <h4 class="my-3">Add Product</h4>

        @if(isset($subcategories) &&$subcategories->count() ==0)

            <div class="alert alert-warning" role="alert">
                You must add sub categories before adding product to category {{$category->name_en}}
            </div>
        @endif
        @if(isset($brands) &&$brands->count() ==0 )
            <div class="alert alert-warning" role="alert">
                You must add brands before adding product
            </div>
        @endif

        <img id="preview">
        <form id="addProductForm" class="my-2">
            @csrf
            <input type="hidden" name="coach_id" value="{{\Illuminate\Support\Facades\Auth::user()?->id}}">
            <div class="row">
                <div class="my-1 col-md-6">
                    <label for="cover_image">Cover_image</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*"
                           onchange="previewImage(event)">
                </div>
                <div class="my-1 col-md-6">
                    <label for="images">Images</label>
                    <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
                </div>

                <input type="hidden" name="category_id" value="{{$category->id}}">
                @if(isset($subcategories))
                    <div class="my-1 col">
                        <label for="subcategory_id">Category</label>
                        <select class="form-select" id="subcategory_id" name="category_id">
                            <option value="">--select category--</option>
                            @foreach($subcategories as $category)
                                <option value="{{$category->id}}">{{$category->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if(isset($brands))
                    <div class="my-1 col">
                        <label for="brand_id">Brand</label>
                        <select class="form-select" id="brand_id" name="brand_id">
                            <option value="">--select brand--</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="my-1 col-12">
                    <label for="name_en">Name En</label>
                    <input type="text" class="form-control" id="name_en" name="name"
                           placeholder="Product Name In English *">
                </div>
                <div class="my-1 col-md-6">
                    <label for="name_ar">Name Ar</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                           placeholder="Product Name In Arabic *">
                </div>
                <div class="my-1 col-md-6">
                    <label for="name_ku">Name Ku</label>
                    <input type="text" class="form-control" id="name_ku" name="name_ku"
                           placeholder="Product Name In Kurdish *">
                </div>
                <div class="my-1 col-12">
                    <label for="description_en">Description En</label>
                    <textarea type="text" class="form-control" id="description_en" name="description"
                              placeholder="Product Description In English *"></textarea>
                </div>
                <div class="my-1 col-md-6">
                    <label for="description_ar">Description Ar</label>
                    <textarea type="text" class="form-control" id="description_ar" name="description_ar"
                              placeholder="Product Description In Arabic *"></textarea>
                </div>
                <div class="my-1 col-md-6">
                    <label for="description_ku">Description Ku</label>
                    <textarea type="text" class="form-control" id="description_ku" name="description_ku"
                              placeholder="Product Description In Kurdish *"></textarea>
                </div>
                <div class="my-1 col-md-4">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"
                           placeholder="Product Description In Kurdish *">
                </div>

                <div class="my-1 col-md-4">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price"
                           placeholder="Price *">
                </div>
                <div class="my-1 col-md-4">
                    <label for="discount">Discount</label>
                    <input type="text" class="form-control" id="discount" name="discount"
                           placeholder="Discount in percent *">
                </div>
                <div id="color" class="row my-2">
                    <div class="d-flex flex-row justify-content-between">
                        <label for="" class="col-6">Colors</label>

                        <button onclick="addColor()" type="button" class="btn btn-success">Add color</button>
                    </div>
                    <div id="colorsContainer" class="row">
                    </div>
                </div>

                <div id="siezes" class="row my-2">
                    <div class="d-flex flex-row justify-content-between">
                        <label for="" class="col-6">Sizes <span class="text-muted"> EX(1KG or Large)</span></label>

                        <button onclick="addSize()" type="button" class="btn btn-success">Add size</button>
                    </div>
                    <div id="sizesContainer" class="row">
                    </div>
                </div>
            </div>
            <div class="my-1">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </form>
    </div>

@endsection
@section('scripts')
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

