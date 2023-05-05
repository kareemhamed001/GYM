@extends('layouts.app-blog-create')
@section('content')
    <div class="row my-2">

        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('coach')}}">Coach</a></li>
                <li class="breadcrumb-item"><a href="{{url('coach/products')}}">products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create product</li>
            </ol>
        </nav>
        <h4 class="my-3">Add Product</h4>


        @if($brands->count()==0 )
            <div class="alert alert-warning" role="alert">
                You must add brands before adding product
            </div>
        @endif
        @if($categories->count()==0 )
            <div class="alert alert-warning" role="alert">
                You must add categories before adding product
            </div>
        @endif

        <img id="preview" src="{{asset($product->cover_image)}}">
        <form id="editProductForm" class="my-2">
            @csrf
            @method('PUT')
            <input type="hidden" name="coach_id" value="{{\Illuminate\Support\Facades\Auth::user()?->id??1}}">
            <div class="row">
                <div class="my-1 col-md-6">
                    <label for="cover_image">Cover_image</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*"
                           onchange="previewImage(event)">
                </div>

                <div class="my-1 col-md-3">
                    <label for="brand_id">Brand</label>
                    <select class="form-select" id="brand_id" name="brand_id">
                        <option value="{{$product->brand_id}}">{{$product->brand->name}}</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-1 col-md-3">
                    <label for="category_id">Category</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="{{$product->category_id}}">{{$product->category->name}}</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-1 col-12">
                    <label for="name_en">Name En</label>
                    <input type="text" class="form-control" id="name_en" name="name"
                           placeholder="Product Name In English *" value="{{$product->name}}">
                </div>
                <div class="my-1 col-md-6">
                    <label for="name_ar">Name Ar</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                           placeholder="Product Name In Arabic *" value="{{$product->name_ar}}">
                </div>
                <div class="my-1 col-md-6">
                    <label for="name_ku">Name Ku</label>
                    <input type="text" class="form-control" id="name_ku" name="name_ku"
                           placeholder="Product Name In Kurdish *" value="{{$product->name_ku}}">
                </div>
                <div class="my-1 col-12">
                    <label for="description_en">Description En</label>
                    <textarea type="text" class="form-control" id="description_en" name="description"
                              placeholder="Product Description In English *">{{$product->description}}</textarea>
                </div>
                <div class="my-1 col-md-6">
                    <label for="description_ar">Description Ar</label>
                    <textarea type="text" class="form-control" id="description_ar" name="description_ar"
                              placeholder="Product Description In Arabic *">{{$product->description_ar}}</textarea>
                </div>
                <div class="my-1 col-md-6">
                    <label for="description_ku">Description Ku</label>
                    <textarea type="text" class="form-control" id="description_ku" name="description_ku"
                              placeholder="Product Description In Kurdish *">{{$product->description_ku}}</textarea>
                </div>
                <div class="my-1 col-md-3 col-6">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"
                           placeholder="Product Description In Kurdish *" value="{{$product->quantity}}">
                </div>
                <div class="my-1 col-md-3 col-6">
                    <label for="unit">Unit(EX.KG)</label>
                    <input type="text" class="form-control" id="unit" name="unit"
                           placeholder="Unit of product *" value="{{$product->unit}}">
                </div>
                <div class="my-1 col-md-3 col-6">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price"
                           placeholder="Price *" value="{{$product->price}}">
                </div>
                <div class="my-1 col-md-3 col-6">
                    <label for="discount">Discount</label>
                    <input type="text" class="form-control" id="discount" name="discount"
                           placeholder="Discount in percent *" value="{{$product->discount}}">
                </div>

                <div class="my-1 col-md-12 row">
                    <label for="images">Images</label>
                    @foreach($product->images as $image)
                        <div class="col-md-3 my-1 px-1" id="image{{$image->id}}">
                            <div class="card p-0 position-relative" style="height: 250px">
                                <i class="position-absolute btn  btn-outline-danger top-0 end-0 fa-light fa-x p-2 m-1 "
                                   onclick="deleteImage({{$product->id}},{{$image->id}},'image{{$image->id}}')"></i>
                                <a href="{{url($image->image)}}" class="w-100 h-100" target="_blank">

                                    <img class="img-fluid w-100 h-100" style="object-fit: scale-down"
                                         src="{{asset($image->image)}}" alt="product image">
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="my-1 col-md-12">
                    <label for="images">Images</label>
                    <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
                </div>

                <div id="color" class="row my-2">
                    <div class="d-flex flex-row justify-content-between">
                        <label for="" class="col-6">Colors</label>

                        <button onclick="addColor()" type="button" class="btn btn-success">Add color</button>
                    </div>
                    <div id="colorsContainer" class="row">
                        @foreach($product->colors as $color)
                            <div class="col-md-2 col-sm-3 col-4 col-lg-2 p-1 my-1" id="color{{$color->id}}">
                                <div class="card border overflow-hidden">
                                    <div class="card-body p-1 ">

                                        <input class="form-control-color w-100  rounded border border-dark" type="color"
                                               value="{{$color->value}}">
                                    </div>
                                    <div class="card-footer  col-12 p-1">
                                        <button class="btn btn-sm btn-outline-danger w-100" type="button"
                                                onclick="deleteColor({{$product->id}},{{$color->id}},'color{{$color->id}}')">
                                            <i
                                                class=" fa-light fa-remove "></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="siezes" class="row my-2">
                    <div class="d-flex flex-row justify-content-between">
                        <label for="" class="col-6">Sizes <span class="text-muted"> EX(1KG or Large)</span></label>

                        <button onclick="addSize()" type="button" class="btn btn-success">Add size</button>
                    </div>
                    <div id="sizesContainer" class="row">

                        @foreach($product->sizes as $size)
                            <div class="col-md-3 col-sm-3 col-4 col-lg-2 p-1 my-1" id="size{{$size->id}}">
                                <div class="card border overflow-hidden">
                                    <div class="card-body p-1 ">
                                        <input class="form-control w-100  rounded border border-dark" type="text"
                                               value="{{$size->value}}">
                                    </div>
                                    <div class="card-footer  p-1">
                                        <button class="btn btn-sm btn-outline-danger w-100" type="button"
                                                onclick="deleteSize({{$product->id}},{{$size->id}},'size{{$size->id}}')">
                                            <i class=" fa-light fa-remove "></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="my-1">
                <button type="submit" class="btn btn-primary" form="editProductForm">Edit</button>
            </div>

        </form>
    </div>

@endsection
@section('scripts')
    <script>
        let form = document.querySelector('#editProductForm')

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            console.log('/api/products/{{$product->id}}')
            let formData = new FormData(form)
            try {
                let response = await fetch('/api/products/{{$product->id}}', {
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


        async function deleteImage(productId, imageId, parentElement) {
            try {
                let response = await fetch(`/api/products/${productId}/${imageId}/delete-image`, {
                    method: 'post'
                });
                let result = await response.json();
                if (result.status == 200) {
                    $(`#${parentElement}`).remove()
                }

            } catch (error) {
                console.error(error)
            }
        }

        let colorCounter = {{$color->id+1}}

            function
        addColor()
        {
            colorCounter++;

            $('#colorsContainer').append(`
                <div class="col-md-2 col-sm-3 col-4 col-lg-2 p-1 my-1" id="color${colorCounter}">
                    <div class="card border overflow-hidden">
                        <div class="card-body p-1 ">
                            <input class="form-control-color w-100  rounded border border-dark" type="color" name="colors[]">
                        </div>
                        <div class="card-footer  col-12 p-1">
                            <button class="btn btn-sm btn-outline-danger w-100" type="button" onclick="deleteColor('','','color${colorCounter}')"><i class=" fa-light fa-remove "></i></button>
                        </div>
                    </div>
                </div>
            `)
        }

        async function deleteColor(productId, colorId, parentElement) {
            try {
                if (colorId) {
                    let response = await fetch(`/api/products/${productId}/${colorId}/delete-color`, {
                        method: 'post'
                    })

                    let result = await response.json();
                    console.log(result)
                    if (result.status === 200) {
                        $(`#${parentElement}`).remove()
                    }
                } else {
                    $(`#${parentElement}`).remove()
                }

            } catch (error) {
                console.error(error)
            }

        }


        @if(isset($size))
        let sizeCounter = {{$size->id+1}}
            @else
            let sizeCounter = 0
        @endif


        function addSize() {
            sizeCounter++;

            $('#sizesContainer').append(`
                <div class="col-md-3 col-sm-3 col-4 col-lg-2 p-1 my-1" id="size${sizeCounter}">
                    <div class="card border overflow-hidden">
                        <div class="card-body p-1 ">
                            <input class="form-control w-100  rounded border border-dark" type="text" name="sizes[]">
                        </div>
                        <div class="card-footer  p-1">
                            <button class="btn btn-sm btn-outline-danger w-100" type="button" onclick="deleteSize('','','size${sizeCounter}')"><i class=" fa-light fa-remove "></i></button>
                        </div>
                    </div>
                </div>
            `)
        }

        async function deleteSize(productId, sizeId, parentElement) {
            try {
                if (sizeId) {
                    let response = await fetch(`/api/products/${productId}/${sizeId}/delete-size`, {
                        method: 'post'
                    })

                    let result = await response.json();
                    console.log(result)
                    if (result.status === 200) {
                        $(`#${parentElement}`).remove()
                    }
                } else {
                    $(`#{parentElement}`).remove()
                }

            } catch (error) {
                console.error(error)
            }

        }
    </script>
@endsection

