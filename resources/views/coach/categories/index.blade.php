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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deleteSelected()">Delete</button>
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
                        <input type="hidden" name="coach_id" value="{{Auth::user()->id}}">
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


    <div class="row my-3">

            <h3>Categories</h3>


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
                        <div class="media">
                            <div class="avatar me-2">
                                <img alt="avatar" src="{{asset($category->cover_image)}}" class="rounded-circle"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="mb-0">{{$category->name_en}}</h6>
                                <span class="text-success d-block" style="word-break: break-word">{{Str::substr($category->description_en,0,50)}}... </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0">{{$category->name_ar??'NULL'}}</p>
                        <span class="text-success d-block">{{Str::substr($category->description_ar,0,50)??'NULL'}}...</span>
                    </td>
                    <td>
                        <p class="mb-0">{{$category->name_ku??'NULL'}}</p>
                        <span class="text-success d-block">{{Str::substr($category->description_ku,0,50)??'NULL'}}...</span>
                    </td>
                    <td class="text-center">
                        <p class="mb-0">{{\Carbon\Carbon::make($category->created_at)->toDateString()??'NULL'}}</p>
                        <span
                            class="text-success">{{\Carbon\Carbon::make($category->created_at)->toTimeString()??'NULL'}}</span>
                    </td>
                    <td class="cursor-pointer  ">
                        <div class="d-flex align-items-center  ">

                            <a onclick="preparecategorytoedit({{$category->id}})"
                               href="javascript:void(0);" class="action-btn btn-edit bs-tooltip m-auto"
                               data-placement="top" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit-2">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                            </a>

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

                document.querySelector('#categoryNameEnEdit').value = result.data.name_en;
                document.querySelector('#categoryNameArEdit').value = result.data.name_ar;
                document.querySelector('#categoryNameKuEdit').value = result.data.name_ku;
                document.querySelector('#categoryDescriptionEnEdit').value = result.data.description_en;
                document.querySelector('#categoryDescriptionArEdit').value = result.data.description_ar;
                document.querySelector('#categoryDescriptionKuEdit').value = result.data.description_ku;
                document.querySelector('#coverImageEdit').src = `http://gym.test/${result.data.cover_image}`
                $('#editCategoryModal').modal('show')

            } else if (result.status === 400) {
                console.log(result)
                let messages = result
                Swal.fire({
                    title: "error",
                    text: messages,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                })

            }
        }

        function closeeditmodal() {
            $('#editCategoryModal').modal('hide')
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

