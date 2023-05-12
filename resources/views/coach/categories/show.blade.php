@extends('layouts.app-blog-create')

@section('title',$category->name)

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="deletecategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete category?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        the category will be deleted forever!
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button  type="button" class="btn btn-danger" onclick="deletecategory()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="editCategoryModal" tabindex="-1" role="dialog"
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
                    <form id="editCategoryForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-6 my-1">
                            <img id="coverImageEdit" style="object-fit: scale-down" class="img-fluid" src="" alt="">
                        </div>

                        <div class="form-group col-6 my-1 ps-2">
                            <label for="coverImage">Cover Image</label>
                            <input name="cover_image" class="form-control-file" type="file" id="coverImage"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="categoryNameEnEdit">Name En</label>
                            <input name="name" class="form-control" type="text" id="categoryNameEnEdit"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryNameArEdit">Name Ar</label>
                            <input name="name_ar" class="form-control" type="text" id="categoryNameArEdit"
                                   placeholder="Enter name in arabic">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryNameKuEdit">Name Ku</label>
                            <input name="name_ku" class="form-control" type="text" id="categoryNameKuEdit"
                                   placeholder="Enter name in kurdish">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="categoryDescriptionEnEdit">Description En</label>
                            <textarea name="description" class="form-control" type="text" id="categoryDescriptionEnEdit"
                                      placeholder="Enter Description in english"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryDescriptionArEdit">Description Ar</label>
                            <textarea name="description_ar" class="form-control" type="text"
                                      id="categoryDescriptionArEdit"
                                      placeholder="Enter Description in arabic"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryDescriptionKuEdit">Description Ku</label>
                            <textarea name="description_ku" class="form-control" type="text"
                                      id="categoryDescriptionKuEdit"
                                      placeholder="Enter Description in kurdish"></textarea>
                        </div>

                        <hr>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeeditmodal()">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" form="editCategoryForm">Save changes</button>

                </div>
            </div>
        </div>
    </div>


    <div class="row my-3 flex-column flex-lg-row align-items-center">

        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('coach')}}">Coach</a></li>
                <li class="breadcrumb-item"><a href="{{url('coach/categories')}}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
            </ol>
        </nav>
        <div class="d-flex col-lg-6 flex-wrap justify-content-center">

                <a type="button" data-toggle="modal" data-target="#deletecategoryModal" title="Delete"
                   class="btn btn-sm btn-danger mx-1 d-flex align-items-center col-5 col-lg my-1 my-lg-0" onclick="preparecategory({{$category->id}})">
                    <i class="fa-light fa-trash fa-2xs fs-6 mx-1"></i> Delete
                </a>
                <a onclick="preparecategorytoedit({{$category->id}})"
                    href="javascript:void(0);" title="Edit"
                     class="btn btn-sm btn-success mx-1 d-flex align-items-center col-5 col-lg my-1 my-lg-0">
                    <i class="fa-light fa-pen fa-2xs fs-6 mx-1"></i> Edit
                </a>

                <a href="{{url('coach/categories')}}" class="btn btn-sm btn-primary mx-1 d-flex align-items-center col-5 col-lg my-1 my-lg-0" title="go back">
                    <i class="fa-light  fa-arrow-left fa-2xs fs-6 mx-1"></i>  Back
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
            <img class="w-100 h-100 rounded" style="object-fit: scale-down" src="{{asset($category->cover_image)}}"
                 alt="">
        </div>

        <div class="d-flex flex-column flex-lg-row my-2">

            <div class="row">
                <div class="my-2">
                    <div class="form-group">
                        <label class="form-label" for="">Name En</label>
                        <input class="form-control text-black disabled" type="text" value="{{$category->name}}"
                               disabled>
                    </div>
                </div>
                <div class="my-2 col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="">Name Ar</label>
                        <input class="form-control text-black disabled" type="text" value="{{$category->name_ar}}"
                               disabled>
                    </div>
                </div>
                <div class="my-2 col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="">Name Ku</label>
                        <input class="form-control text-black disabled" type="text" value="{{$category->name_ku}}"
                               disabled>
                    </div>
                </div>
                <div class="my-2 ">
                    <div class="form-group">
                        <label class="form-label" for="">Description En</label>
                        <textarea class="form-control text-black disabled" type="text"
                                  disabled>{{$category->description}}</textarea>
                    </div>
                </div>
                <div class="my-2 col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="">Description Ar</label>
                        <textarea class="form-control text-black disabled" type="text"
                                  disabled>{{$category->description_ar}}</textarea>
                    </div>
                </div>
                <div class="my-2 col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="">Description Ku</label>
                        <textarea class="form-control text-black disabled" type="text"
                                  disabled>{{$category->description_ku}}</textarea>
                    </div>
                </div>

            </div>

        </div>


    </div>

    <div class="row my-3">

        <h3 class="text-capitalize">Brands in this category</h3>

    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">EN</th>
                <th scope="col">AR</th>
                <th scope="col">KU</th>
                <th scope="col">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>
                        <div class="media">
                            <div class="avatar me-2">
                                <img alt="avatar" src="{{asset($brand->cover_image)}}" class="rounded-circle"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="mb-0">{{$brand->name}}</h6>
                                <span class="text-success">{{$brand->description}}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0">{{$brand->name_ar??'NULL'}}</p>
                        <span class="text-success">{{$brand->description_ar??'NULL'}}</span>
                    </td>
                    <td>
                        <p class="mb-0">{{$brand->name_ku??'NULL'}}</p>
                        <span class="text-success">{{$brand->description_ku??'NULL'}}</span>
                    </td>


                    <td class="cursor-pointer ">
                        <div class="d-flex align-items-center">


                            <div class="action-btns ">
                                <a href="{{url('coach/brands',$brand->id)}}" class="action-btn btn-view bs-tooltip me-2"
                                   data-toggle="tooltip" data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                            </div>

                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$brands->links()}}

    </div>
@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            $('#selectAll').click(function () {
                $('[name="categories[]"]').prop('checked', this.checked);
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        let categoryId;
        let price;

        function preparecategory(id) {
            categoryId = id;
        }

        let categoryIdEdit = 0

        async function preparecategorytoedit(id) {
            categoryIdEdit = id
            showLoader()
            const response = await fetch(`/api/categories/${id}`, {
                method: 'GET'
            });
            removeLoader()
            const result = await response.json();
            if (result.status === 200) {

                document.querySelector('#categoryNameEnEdit').value = result.data.name;
                document.querySelector('#categoryNameArEdit').value = result.data.name_ar;
                document.querySelector('#categoryNameKuEdit').value = result.data.name_ku;
                document.querySelector('#categoryDescriptionEnEdit').value = result.data.description;
                document.querySelector('#categoryDescriptionArEdit').value = result.data.description_ar;
                document.querySelector('#categoryDescriptionKuEdit').value = result.data.description_ku;
                document.querySelector('#coverImageEdit').src = `http://gym.test/${result.data.cover_image}`
                $('#editCategoryModal').modal('show')

            } else if (result.status === 400) {


            }
        }

        function closeeditmodal() {
            $('#editCategoryModal').modal('hide')
        }

        async function deletecategory() {
            if (categoryId) {
                showLoader()
                $.ajax({
                    url: `http://gym.test/api/categories/${categoryId}`,
                    method: 'DELETE',
                    success: function (response) {
                        removeLoader()
                        Swal.fire({
                            title: "Success",
                            text: `category ${categoryId} deleted successfully`,
                            icon: "success",
                            button: "Ok",
                            position: 'center',
                            timer: 3000
                        })

                        categoryId = null
                        price = null
                        $('#deletecategoryModal').modal('hide')

                        window.location.replace('/coach/categories')
                    },
                    error: function (error) {
                        removeLoader()
                        price = null;
                        categoryId = null;
                        let messages = error.responseJSON.message
                        // $.each(messages, function(index, value) {
                        //     console.log(`Item at index ${index} is ${value}`);
                        // });

                    }
                });
            } else {
                removeLoader()
                swal("category id not set", "error");
            }
        }

    </script>

    <script>

        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const editForm = document.querySelector('#editCategoryForm');
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formDataEdit = new FormData(editForm);

            try {
                showLoader()
                const response = await fetch(`/api/categories/${categoryIdEdit}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formDataEdit
                });
                removeLoader()

                const result = await response.json();
                console.log(result)
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Updated Successfully',
                    })

                    $('#addCategoryModal').modal('hide')
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
                removeLoader()
                console.error(error);
            }
        });

    </script>
@endsection
