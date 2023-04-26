@extends('layouts.app-blog-create')

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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deletecategory()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteArrayOfCategoriesModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Selected categories?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        these categories will be deleted forever !
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deleteSelected()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-xl" id="addCategoryModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">add a new category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createCategoryForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-12 my-1">
                            <label for="coverImage">Cover Image</label>
                            <input name="cover_image" class="form-control-file" type="file" id="coverImage"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="categoryNameEn">Name En</label>
                            <input name="name" class="form-control" type="text" id="categoryNameEn"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryNameAr">Name Ar</label>
                            <input name="name_ar" class="form-control" type="text" id="categoryNameAr"
                                   placeholder="Enter name in arabic">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryNameKu">Name Ku</label>
                            <input name="name_ku" class="form-control" type="text" id="categoryNameKu"
                                   placeholder="Enter name in kurdish">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="categoryDescriptionEn">Description En</label>
                            <textarea name="description" class="form-control" type="text" id="categoryDescriptionEn"
                                      placeholder="Enter Description in english"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryDescriptionAr">Description Ar</label>
                            <textarea name="description_ar" class="form-control" type="text" id="categoryDescriptionAr"
                                      placeholder="Enter Description in arabic"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryDescriptionKu">Description Ku</label>
                            <textarea name="description_ku" class="form-control" type="text" id="categoryDescriptionKu"
                                      placeholder="Enter Description in kurdish"></textarea>
                        </div>

                        <hr>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="createCategoryForm">Save changes</button>

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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeeditmodal()">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" form="editCategoryForm">Save changes</button>

                </div>
            </div>
        </div>
    </div>


    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h3>Categories</h3>
            <div>
                <button type="button" data-toggle="modal" data-target="#deleteArrayOfCategoriesModal"
                        title="delete selected orders"
                        class="btn btn-danger">Delete
                </button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addCategoryModal">
                    Add
                </button>

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
            @foreach($categories as $category)
                <tr>
                    <td>
                        <div class="form-check form-check-primary">
                            <input class="form-check-input" type="checkbox" name="categories[]"
                                   value="{{$category->id}}">
                        </div>
                    </td>
                    <td>
                        <div class="media">
                            <div class="avatar me-2">
                                <img alt="avatar" src="{{asset($category->cover_image)}}" class="rounded-circle"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="mb-0">{{$category->name}}</h6>
                                <span class="text-success">{{$category->description}}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0">{{$category->name_ar??'NULL'}}</p>
                        <span class="text-success">{{$category->description_ar??'NULL'}}</span>
                    </td>
                    <td>
                        <p class="mb-0">{{$category->name_ku??'NULL'}}</p>
                        <span class="text-success">{{$category->description_ku??'NULL'}}</span>
                    </td>
                    <td class="text-center">
                        <p class="mb-0">{{\Carbon\Carbon::make($category->created_at)->toDateString()??'NULL'}}</p>
                        <span
                            class="text-success">{{\Carbon\Carbon::make($category->created_at)->toTimeString()??'NULL'}}</span>
                    </td>
                    <td class="cursor-pointer ">
                        <div class="d-flex align-items-center">


                            <div class="action-btns">
                                <a href="{{url('coach/categories',$category->id)}}" class="action-btn btn-view bs-tooltip me-2"
                                   data-toggle="tooltip" data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a onclick="preparecategorytoedit({{$category->id}})"
                                   href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                   data-placement="top" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                                <a type="button" data-toggle="modal" data-target="#deletecategoryModal"
                                   href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                   data-placement="top" title="Delete" onclick="preparecategory({{$category->id}})">
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
        {{$categories->links()}}

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
            showLoader();
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
                    url: `/api/categories/${categoryId}`,
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
                        location.reload();
                    },
                    error: function (error) {
                        removeLoader()
                        price = null;
                        categoryId = null;
                        let messages = error.responseJSON.message
                        // $.each(messages, function(index, value) {
                        //     console.log(`Item at index ${index} is ${value}`);
                        // });
                        Swal.fire({
                            title: "error",
                            text: messages,
                            icon: "error",
                            button: "Ok",
                            position: 'center',
                            timer: 3000
                        })
                    }
                });
            } else {
                removeLoader()
                swal("category id not set", "error");
                Swal.fire({
                    title: "error",
                    text: `category id not set`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                })
            }
        }


        function deleteSelected() {
            let checkboxes = $('[name="categories[]"]:checked');
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

                showLoader()
                $.ajax({
                    url: `http:\\api/categories/delete-collection`,
                    method: 'POST',
                    data: {'categories': selectedValues},
                    success: function (response) {
                        removeLoader()
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
                        $('#deleteArrayOfCategoriesModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        removeLoader()
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
                removeLoader()

                Swal.fire({
                    title: "No categories selected",
                    text: `select at least one category to delete`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                })
                $('#deleteArrayOfCategoriesModal').modal('hide')
            }


        }

    </script>

    <script>


        const form = document.querySelector('#createCategoryForm');


        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                showLoader()
                const response = await fetch('/api/categories', {
                    method: 'post',
                    body: formData
                });
                removeLoader()
                const result = await response.json();
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
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

