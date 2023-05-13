@extends('layouts.app-blog-create')

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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deleteproduct()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteArrayOfproductsModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Selected products?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        these products will be deleted forever !
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deleteSelected()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h3>products</h3>
            <div>
                <button type="button" data-toggle="modal" data-target="#deleteArrayOfproductsModal"
                        title="delete selected orders"
                        class="btn btn-danger">Delete
                </button>
                <a href="{{url('coach/category/'.$category->id.'/products/create')}}"  class="btn btn-primary">
                    Add
                </a>

            </div>

        </div>
        <div class="row my-2">
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


        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th class="checkbox-area" scope="col">
                    <div class="form-check form-check-primary">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                    </div>
                </th>
                <th scope="col">EN</th>
                <th scope="col">AR</th>
                <th scope="col">KU</th>
                <th scope="col" class="text-center">Created_At</th>
                <th scope="col" class="text-center">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <div class="form-check form-check-primary">
                            <input class="form-check-input" type="checkbox" name="products[]"
                                   value="{{$product->id}}">
                        </div>
                    </td>
                    <td>
                        <div class="media">
                            <div class="avatar me-2">
                                <img alt="avatar" src="{{asset($product->cover_image)}}" class="rounded-circle"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="mb-0">{{$product->name}}</h6>
                                <span class="text-success">{{$product->description}}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0">{{$product->name_ar??'NULL'}}</p>
                        <span class="text-success">{{$product->description_ar??'NULL'}}</span>
                    </td>
                    <td>
                        <p class="mb-0">{{$product->name_ku??'NULL'}}</p>
                        <span class="text-success">{{$product->description_ku??'NULL'}}</span>
                    </td>
                    <td class="text-center">
                        <p class="mb-0">{{\Carbon\Carbon::make($product->created_at)->toDateString()??'NULL'}}</p>
                        <span
                            class="text-success">{{\Carbon\Carbon::make($product->created_at)->toTimeString()??'NULL'}}</span>
                    </td>
                    <td class="cursor-pointer ">
                        <div class="d-flex align-items-center">


                            <div class="action-btns">
                                <a href="{{url('/product',$product->id)}}" class="action-btn btn-view bs-tooltip me-2"
                                   data-toggle="tooltip" data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a
                                   href="{{url('coach/category/'.$category->id.'/products/'.$product->id.'/edit')}}" class="action-btn btn-edit bs-tooltip me-2"
                                   data-placement="top" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                                <a type="button" data-toggle="modal" data-target="#deleteproductModal"
                                   href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                   data-placement="top" title="Delete" onclick="prepareproduct({{$product->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-trash-2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </a>
                            </div>

                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->links()}}

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
            console.log(id)
            productId = id;
        }






        async function deleteproduct() {


            if (productId) {
                try {
                    const response = await fetch(`/api/products/${productId}`, {
                        method: 'delete'
                    });

                    const result = await response.json();
                    if (result.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message,
                        })

                        $('#deleteproductModal').modal('hide')
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

                $.ajax({
                    url: `/api/products/${productId}`,
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

                        $('#deleteproductModal').modal('hide')
                        location.reload();
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
                swal.fire({
                    title: "Error",
                    text: `product Id does not set`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                });
            }
        }


        function deleteSelected() {
            let checkboxes = $('[name="products[]"]:checked');
            // Create an empty array to store the selected values
            let selectedValues = [];
            // Loop through the checked checkboxes and push their values to the array
            checkboxes.each(function () {
                selectedValues.push(parseInt($(this).val()));
            });

            console.log(selectedValues)

            if (selectedValues.length > 0) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: `http:\\api/products/delete-collection`,
                    method: 'POST',
                    data: {'products': selectedValues},
                    success: function (response) {
                        console.log(response)
                        Swal.fire({
                            title: "Success",
                            text: `deleted successfully`,
                            icon: "success",
                            button: "Ok",
                            position: 'center',
                            timer: 3000
                        })
                        selectedValues = null
                        $('#deleteArrayOfproductsModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        let messages = error.responseJSON.message
                        Swal.fire({
                            title: "error",
                            text: `Something went wrong`,
                            icon: "error",
                            button: "Hide",
                            position: 'center',
                            timer: 3000
                        })
                    }
                });
            } else {

                Swal.fire({
                    title: "No products selected",
                    text: `select at least one product to delete`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                })
                $('#deleteArrayOfproductsModal').modal('hide')
            }


        }

    </script>

    <script>


        const form = document.querySelector('#createproductForm');


        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                const response = await fetch('/api/products', {
                    method: 'post',
                    body: formData
                });

                const result = await response.json();
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
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
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

    </script>
@endsection

