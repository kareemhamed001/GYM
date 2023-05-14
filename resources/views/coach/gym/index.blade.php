@extends('layouts.app-blog-create')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="deletegymModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete gym?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        the gym will be deleted forever!
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deletegym()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteArrayOfgymsModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Selected gyms?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        these gyms will be deleted forever !
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
    <!-- Modal -->
    <div class="modal fade modal-xl" id="addgymModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">add a new gym</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="creategymForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        <input name="coach_id" type="hidden" value="{{Auth::user()->id}}">
                        <div class="form-group col-12 my-1">
                            <label for="coverImage">Cover Image</label>
                            <input name="cover_image" class="form-control-file" type="file" id="coverImage"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-md-4 my-1">
                            <label for="gymNameEn">Name En</label>
                            <input name="name_en" class="form-control" type="text" id="gymNameEn"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-md-4 px-1 my-1">
                            <label for="gymNameAr">Name Ar</label>
                            <input name="name_ar" class="form-control" type="text" id="gymNameAr"
                                   placeholder="Enter name in arabic">
                        </div>
                        <div class="form-group col-md-4 px-1 my-1">
                            <label for="gymNameKu">Name Ku</label>
                            <input name="name_ku" class="form-control" type="text" id="gymNameKu"
                                   placeholder="Enter name in kurdish">
                        </div>
                        <div class="form-group col-md-4  my-1">
                            <label for="gymDescriptionEn">Description En</label>
                            <textarea name="description_en" class="form-control" type="text" id="gymDescriptionEn"
                                      placeholder="Enter Description in english"></textarea>
                        </div>
                        <div class="form-group col-md-4 px-1 my-1">
                            <label for="gymDescriptionAr">Description Ar</label>
                            <textarea name="description_ar" class="form-control" type="text" id="gymDescriptionAr"
                                      placeholder="Enter Description in arabic"></textarea>
                        </div>
                        <div class="form-group col-md-4 px-1 my-1">
                            <label for="gymDescriptionKu">Description Ku</label>
                            <textarea name="description_ku" class="form-control" type="text" id="gymDescriptionKu"
                                      placeholder="Enter Description in kurdish"></textarea>
                        </div>
                        <div class="form-group col-md-3 px-1 my-1">
                            <label for="price">Price</label>
                            <input name="price" class="form-control" type="number" id="price"
                                      placeholder="Enter price">
                        </div>
                        <div class="form-group col-md-3 px-1 my-1">
                            <label for="open_at">opens at</label>
                            <input name="open_at" class="form-control" type="time" id="open_at">
                        </div>


                        <div class="form-group col-md-3 px-1 my-1">
                            <label for="close_at">closes at</label>
                            <input name="close_at" class="form-control" type="time" id="close_at">
                        </div>

                        <div class="form-group col-md-3 px-1 my-1">
                            <label for="address">address</label>
                            <input name="address" class="form-control" type="text" id="address"
                                      placeholder="Enter address">
                        </div>


                        <hr>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="creategymForm">Save changes</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="editgymModal" tabindex="-1" role="dialog"
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
                    <form id="editgymForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input name="coach_id" type="hidden" value="{{Auth::user()->id}}">
                        <div class="col-6 my-1">
                            <img id="coverImageEdit" style="object-fit: scale-down" class="img-fluid" src="" alt="">
                        </div>

                        <div class="form-group col-6 my-1 ps-2">
                            <label for="coverImage">Cover Image</label>
                            <input name="cover_image" class="form-control-file" type="file" id="coverImage"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="gymNameEnEdit">Name En</label>
                            <input name="name" class="form-control" type="text" id="gymNameEnEdit"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="gymNameArEdit">Name Ar</label>
                            <input name="name_ar" class="form-control" type="text" id="gymNameArEdit"
                                   placeholder="Enter name in arabic">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="gymNameKuEdit">Name Ku</label>
                            <input name="name_ku" class="form-control" type="text" id="gymNameKuEdit"
                                   placeholder="Enter name in kurdish">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="gymDescriptionEnEdit">Description En</label>
                            <textarea name="description" class="form-control" type="text" id="gymDescriptionEnEdit"
                                      placeholder="Enter Description in english"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="gymDescriptionArEdit">Description Ar</label>
                            <textarea name="description_ar" class="form-control" type="text"
                                      id="gymDescriptionArEdit"
                                      placeholder="Enter Description in arabic"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="gymDescriptionKuEdit">Description Ku</label>
                            <textarea name="description_ku" class="form-control" type="text"
                                      id="gymDescriptionKuEdit"
                                      placeholder="Enter Description in kurdish"></textarea>
                        </div>

                        <hr>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeeditmodal()">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" form="editgymForm">Save changes</button>

                </div>
            </div>
        </div>
    </div>


    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h3>Gyms</h3>
            <div>
                <button type="button" data-toggle="modal" data-target="#deleteArrayOfgymsModal"
                        title="delete selected orders"
                        class="btn btn-danger">Delete
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addgymModal">
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
            @foreach($gyms as $gym)
                <tr>
                    <td>
                        <div class="form-check form-check-primary">
                            <input class="form-check-input" type="checkbox" name="gyms[]"
                                   value="{{$gym->id}}">
                        </div>
                    </td>
                    <td>
                        <div class="media">
                            <div class="avatar me-2">
                                <img alt="avatar" src="{{asset($gym->cover_image)}}" class="rounded-circle"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="mb-0">{{$gym->name_en}}</h6>
                                <span class="text-success d-block" style="word-break: break-word">{{Str::substr($gym->description_en,0,50)}}... </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0">{{$gym->name_ar??'NULL'}}</p>
                        <span class="text-success d-block">{{Str::substr($gym->description_ar,0,50)??'NULL'}}...</span>
                    </td>
                    <td>
                        <p class="mb-0">{{$gym->name_ku??'NULL'}}</p>
                        <span class="text-success d-block">{{Str::substr($gym->description_ku,0,50)??'NULL'}}...</span>
                    </td>
                    <td class="text-center">
                        <p class="mb-0">{{\Carbon\Carbon::make($gym->created_at)->toDateString()??'NULL'}}</p>
                        <span
                            class="text-success">{{\Carbon\Carbon::make($gym->created_at)->toTimeString()??'NULL'}}</span>
                    </td>
                    <td class="cursor-pointer ">
                        <div class="d-flex align-items-center">


                            <div class="action-btns">
                                <a href="{{url('coach/gyms',$gym->id)}}" class="action-btn btn-view bs-tooltip me-2"
                                   data-toggle="tooltip" data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a onclick="preparegymtoedit({{$gym->id}})"
                                   href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                   data-placement="top" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                                <a type="button" data-toggle="modal" data-target="#deletegymModal"
                                   href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                   data-placement="top" title="Delete" onclick="preparegym({{$gym->id}})">
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
        {{$gyms->links()}}

    </div>

@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            $('#selectAll').click(function () {
                $('[name="gyms[]"]').prop('checked', this.checked);
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        let gymId;
        let price;

        function preparegym(id) {
            gymId = id;
        }

        let gymIdEdit = 0

        async function preparegymtoedit(id) {

            gymIdEdit = id
            showLoader();
            const response = await fetch(`/api/gyms/${id}`, {
                method: 'GET'
            });
            removeLoader()
            const result = await response.json();
            if (result.status === 200) {

                document.querySelector('#gymNameEnEdit').value = result.data.name_en;
                document.querySelector('#gymNameArEdit').value = result.data.name_ar;
                document.querySelector('#gymNameKuEdit').value = result.data.name_ku;
                document.querySelector('#gymDescriptionEnEdit').value = result.data.description_en;
                document.querySelector('#gymDescriptionArEdit').value = result.data.description_ar;
                document.querySelector('#gymDescriptionKuEdit').value = result.data.description_ku;
                document.querySelector('#coverImageEdit').src = `http://gym.test/${result.data.cover_image}`
                $('#editgymModal').modal('show')

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
            $('#editgymModal').modal('hide')
        }

        async function deletegym() {
            if (gymId) {
                showLoader()
                $.ajax({
                    url: `/api/sub-gyms/${gymId}`,
                    method: 'DELETE',
                    success: function (response) {
                        removeLoader()
                        Swal.fire({
                            title: "Success",
                            text: `gym ${gymId} deleted successfully`,
                            icon: "success",
                            button: "Ok",
                            position: 'center',
                            timer: 3000
                        })

                        gymId = null
                        price = null
                        $('#deletegymModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        removeLoader()
                        price = null;
                        gymId = null;
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
                swal("gym id not set", "error");
                Swal.fire({
                    title: "error",
                    text: `gym id not set`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                })
            }
        }


        function deleteSelected() {
            let checkboxes = $('[name="gyms[]"]:checked');
            // Create an empty array to store the selected values
            let selectedValues = [];
            // Loop through the checked checkboxes and push their values to the array
            checkboxes.each(function () {
                selectedValues.push(parseInt($(this).val()));
            });


            if (selectedValues.length > 0) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                showLoader()
                $.ajax({
                    url: `http:\\api/sub-gyms/delete-collection`,
                    method: 'POST',
                    data: {'gyms': selectedValues},
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
                        $('#deleteArrayOfgymsModal').modal('hide')
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
                    title: "No gyms selected",
                    text: `select at least one gym to delete`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                })
                $('#deleteArrayOfgymsModal').modal('hide')
            }


        }

    </script>

    <script>


        const form = document.querySelector('#creategymForm');


        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                showLoader()
                const response = await fetch('/api/gyms', {
                    method: 'post',
                    body: formData
                });
                removeLoader()
                const result = await response.json();
                console.log(result)
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                    })

                    $('#addgymModal').modal('hide')
                    location.reload();
                } else if (result.status === 400) {
                    let message = result.message;
                    let errorMessage = ``;
                    for (const key in message) {
                        errorMessage +=`<span class="d-block tetx-danger">${message[key]}</span>`
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessage,
                    })
                }

            } catch (error) {
                removeLoader()
                console.error(error);
            }
        });
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const editForm = document.querySelector('#editgymForm');
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formDataEdit = new FormData(editForm);

            try {
                showLoader()
                const response = await fetch(`/api/gyms/${gymIdEdit}`, {
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

                    $('#addgymModal').modal('hide')
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

