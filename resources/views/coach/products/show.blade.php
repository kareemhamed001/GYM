@extends('layouts.app-blog-create')

@section('title',$product->name)

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="deleteproductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete product?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        the product will be deleted forever!
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deleteproduct()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="editproductModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeeditmodal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" class="my-2">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="coach_id" value="{{\Illuminate\Support\Facades\Auth::user()?->id??1}}">
                        <div class="row">
                            <div class="my-1 col-md-6">
                                <img id="coverImageEdit" class="img-fluid">
                            </div>
                            <div class="my-1 col-md-6">
                                <label for="cover_image">Cover_image</label>
                                <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div class="my-1 col-md-6">
                                <label for="brand_id">Brand</label>
                                <select  class="form-select" id="brand_id" name="brand_id" >
                                    <option value="">--select brand--</option>
                                    @foreach(\App\Models\brand::all() as $brand)

                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <div class="my-1 col-6">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity"
                                       placeholder="Product Description In Kurdish *">
                            </div>
                            <div class="my-1 col-6">
                                <label for="unit">Unit(EX.KG)</label>
                                <input type="text" class="form-control" id="unit" name="unit"
                                       placeholder="Unit of product *">
                            </div>
                            <div class="my-1 col-6">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price"
                                       placeholder="Price *">
                            </div>
                            <div class="my-1 col-6">
                                <label for="discount">Discount</label>
                                <input type="text" class="form-control" id="discount" name="discount"
                                       placeholder="Discount in percent *">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeeditmodal()">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" form="editProductForm">Save changes</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="addBrandModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeeditmodal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addBrandForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="form-group px-1 my-1">
                            <label for="brand_id">Brand Id</label>
                            <select name="brand_id" class="form-select" id="brand_id">
                                <option>--Select Brand--</option>
                                @foreach(\App\Models\brand::all() as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeeditmodal()">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" form="addBrandForm">Save changes</button>

                </div>
            </div>
        </div>
    </div>


    <div class="row my-3 flex-column flex-lg-row align-items-center">

        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('coach')}}">Coach</a></li>
                <li class="breadcrumb-item"><a href="{{url('coach/products')}}">products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
            </ol>
        </nav>
        <div class="d-flex col-lg-6 flex-wrap justify-content-center">

            <a type="button" data-toggle="modal" data-target="#deleteproductModal" title="Delete"
               class="btn btn-sm btn-danger mx-1 d-flex align-items-center col-5 col-lg my-1 my-lg-0"
               onclick="prepareproduct({{$product->id}})">
                <i class="fa-light fa-trash fa-2xs fs-6 mx-1"></i> Delete
            </a>
            <a onclick="prepareproducttoedit({{$product->id}})"
               href="javascript:void(0);" title="Edit"
               class="btn btn-sm btn-success mx-1 d-flex align-items-center col-5 col-lg my-1 my-lg-0">
                <i class="fa-light fa-pen fa-2xs fs-6 mx-1"></i> Edit
            </a>
            <a href="{{url('coach/products')}}"
               class="btn btn-sm btn-primary mx-1 d-flex align-items-center col-5 col-lg my-1 my-lg-0" title="go back">
                <i class="fa-light  fa-arrow-left fa-2xs fs-6 mx-1"></i> Back
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
            {{session('error')}}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
            {{session('success')}}
        </div>
    @endif

    <div class="row my-2">
        <div>
            <img class="w-100 h-100 rounded" style="object-fit: scale-down" src="{{asset($product->cover_image)}}"
                 alt="">
        </div>

        <div class="d-flex flex-column flex-lg-row my-2">

            <div class="row">

                <div class="my-1 col-12">
                    <label for="brand_id">Brand</label>
                    <input type="text" class="form-control" id="name_en" value="{{$product->brand->name}}" disabled>
                </div>

                <div class="my-1 col-12">
                    <label for="name_en">Name En</label>
                    <input type="text" class="form-control" id="name_en" value="{{$product->name}}" disabled>
                </div>
                <div class="my-1 col-md-6">
                    <label for="name_ar">Name Ar</label>
                    <input type="text" class="form-control" id="name_ar" value="{{$product->name_ar}}" disabled>
                </div>
                <div class="my-1 col-md-6">
                    <label for="name_ku">Name Ku</label>
                    <input type="text" class="form-control" id="name_ku" value="{{$product->name_ku}}" disabled>
                </div>
                <div class="my-1 col-12">
                    <label for="description_en">Description En</label>
                    <textarea type="text" class="form-control" id="description_en"
                              disabled>{{$product->description}}</textarea>
                </div>
                <div class="my-1 col-12">
                    <label for="description_ar">Description Ar</label>
                    <textarea type="text" class="form-control" id="description_ar"
                              disabled>{{$product->description_ar}}</textarea>
                </div>
                <div class="my-1 col-12">
                    <label for="description_ku">Description Ku</label>
                    <textarea type="text" class="form-control" id="description_ky"
                              disabled>{{$product->description_ky}}</textarea>
                </div>
                <div class="my-1 col-6">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" value="{{$product->quantity}}" disabled>
                </div>
                <div class="my-1 col-6">
                    <label for="unit">Unit(EX.KG)</label>
                    <input type="text" class="form-control" id="unit" value="{{$product->unit}}" disabled>
                </div>
                <div class="my-1 col-6">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" value="{{$product->price}}" disabled>
                </div>
                <div class="my-1 col-6">
                    <label for="discount">Discount</label>
                    <input type="text" class="form-control" id="discount" value="{{$product->discount}} %" disabled>
                </div>
            </div>

        </div>


    </div>

@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            $('#selectAll').click(function () {
                $('[name="products[]"]').prop('checked', this.checked);
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        let productId;
        let price;

        function prepareproduct(id) {
            productId = id;
        }

        let productIdEdit = 0

        async function prepareproducttoedit(id) {
            productIdEdit = id
            const response = await fetch(`/api/products/${id}`, {
                method: 'GET'
            });
            const result = await response.json();
            if (result.status === 200) {
                console.log(result)
                document.querySelector('#name_en').value = result.data.name;
                document.querySelector('#name_ar').value = result.data.name_ar;
                document.querySelector('#name_ku').value = result.data.name_ku;
                document.querySelector('#description_en').value = result.data.description;
                document.querySelector('#description_ar').value = result.data.description_ar;
                document.querySelector('#description_ku').value = result.data.description_ku;
                document.querySelector('#quantity').value = result.data.quantity;
                document.querySelector('#unit').value = result.data.unit;
                document.querySelector('#price').value = result.data.price;
                document.querySelector('#discount').value = result.data.discount;
                document.querySelector('#brand_id').value = result.data.brand_id;
                document.querySelector('#coverImageEdit').src = `http://gym.test/${result.data.cover_image}`
                $('#editproductModal').modal('show')

            } else if (result.status === 400) {

                console.log(result)

            }
        }

        function closeeditmodal() {
            $('#editproductModal').modal('hide')
        }

        async function deleteproduct() {
            if (productId) {
                $.ajax({
                    url: `http://gym.test/api/products/${productId}`,
                    method: 'DELETE',
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: `product ${productId} deleted successfully`,
                            icon: "success",
                            button: "Ok",
                            position: 'center',
                            timer: 3000
                        })

                        productId = null
                        price = null
                        $('#deleteproductModal').modal('hide')

                        window.location.replace('/coach/products')
                    },
                    error: function (error) {
                        price = null;
                        productId = null;
                        let messages = error.responseJSON.message
                        // $.each(messages, function(index, value) {
                        //     console.log(`Item at index ${index} is ${value}`);
                        // });

                    }
                });
            } else {
                swal("product id not set", "error");
            }
        }

    </script>

    <script>

        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const editForm = document.querySelector('#editProductForm');
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formDataEdit = new FormData(editForm);

            try {
                const response = await fetch(`/api/products/${productIdEdit}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formDataEdit
                });

                const result = await response.json();
                console.log(result)
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Updated Successfully',
                    })

                    $('#addproductModal').modal('hide')
                    location.reload();
                } else if (result.status === 400) {
                    let message = result.message;
                    let errorMessage = ``;
                    for (const key in message) {
                        errorMessage += message[key] + `\n`
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    })
                }

            } catch (error) {
                console.error(error);
            }
        });

        const addBrandForm = document.querySelector('#addBrandForm');
        addBrandForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(addBrandForm);

            try {
                const response = await fetch(`/api/brands/to-product`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });

                const result = await response.json();
                console.log(result)
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                        timeout: 3000
                    })

                    $('#addproductModal').modal('hide')
                    location.reload();
                } else if (result.status === 400) {
                    let message = result.message;
                    let errorMessage = ``;
                    for (const key in message) {
                        errorMessage += `<span class="text-danger d-block">${message[key]} </span>`
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessage,
                    })
                }

            } catch (error) {
                console.error(error);
            }
        });
    </script>
@endsection
