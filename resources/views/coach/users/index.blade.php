@extends('layouts.app-blog-create')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="deleteuserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete user?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        the user will be deleted forever!
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deleteuser()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteArrayOfusersModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Selected users?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        these users will be deleted forever !
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
    <div class="modal fade modal-xl" id="adduserModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">add a new user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createuserForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="coach_id" value="{{Auth::user()?->id??1}}">
                        <div class="form-group col-12 my-1">
                            <label for="coverImage">Profile Image</label>
                            <input name="profile_image" class="form-control-file" type="file" id="coverImage">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="userNameEn">Name</label>
                            <input name="name" class="form-control" type="text" id="userNameEn"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="email">Email</label>
                            <input name="email" class="form-control" type="email" id="email"
                                   placeholder="Enter Valid Email">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="phone_number">phone number</label>
                            <input name="phone_number" class="form-control" type="text" id="phone_number"
                                   placeholder="Enter Valid phone number">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="password">password</label>
                            <input name="password" class="form-control" type="password" id="password"
                                   placeholder="Enter Valid phone number">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="country">country</label>
                            <input name="country" class="form-control" type="text" id="country"
                                   placeholder="Enter Valid phone number">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="address">address</label>
                            <input name="address" class="form-control" type="text" id="address"
                                   placeholder="Enter address">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="age">age</label>
                            <input name="age" class="form-control" type="text" id="age"
                                   placeholder="Enter Valid age">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="gender">gender</label>
                            <input name="gender" class="form-control" type="text" id="gender"
                                   placeholder="Enter gender">
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="role_as">role_as</label>
                            <input name="role_as" class="form-control" type="text" id="role_as"
                                   placeholder="Enter role">
                        </div>



                        <hr>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="createuserForm">Save changes</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="edituserModal" tabindex="-1" role="dialog"
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
                    <form id="edituserForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="coach_id" value="{{Auth::user()?->id??1}}">
                        <div class="col-6 my-1">
                            <img id="coverImageEdit" style="object-fit: scale-down" class="img-fluid" src="" alt="">
                        </div>

                        <div class="form-group col-6 my-1 ps-2">
                            <label for="coverImage">Cover Image</label>
                            <input name="cover_image" class="form-control-file" type="file" id="coverImage"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="userNameEnEdit">Name En</label>
                            <input name="name" class="form-control" type="text" id="userNameEnEdit"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="userNameArEdit">Name Ar</label>
                            <input name="name_ar" class="form-control" type="text" id="userNameArEdit"
                                   placeholder="Enter name in arabic">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="userNameKuEdit">Name Ku</label>
                            <input name="name_ku" class="form-control" type="text" id="userNameKuEdit"
                                   placeholder="Enter name in kurdish">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="userDescriptionEnEdit">Description En</label>
                            <textarea name="description" class="form-control" type="text" id="userDescriptionEnEdit"
                                      placeholder="Enter Description in english"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="userDescriptionArEdit">Description Ar</label>
                            <textarea name="description_ar" class="form-control" type="text"
                                      id="userDescriptionArEdit"
                                      placeholder="Enter Description in arabic"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="userDescriptionKuEdit">Description Ku</label>
                            <textarea name="description_ku" class="form-control" type="text"
                                      id="userDescriptionKuEdit"
                                      placeholder="Enter Description in kurdish"></textarea>
                        </div>

                        <hr>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeeditmodal()">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" form="edituserForm">Save changes</button>

                </div>
            </div>
        </div>
    </div>


    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h3>users</h3>
            <div>
                <button type="button" data-toggle="modal" data-target="#deleteArrayOfusersModal"
                        title="delete selected orders"
                        class="btn btn-danger">Delete
                </button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#adduserModal">
                    Add
                </button>

            </div>

        </div>
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <svg> ...</svg>
                </button>
                {{session('error')}}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <svg> ...</svg>
                </button>
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
                <th scope="col">User</th>
                <th scope="col">Address</th>
                <th scope="col">Age</th>
                <th scope="col">Type</th>
                <th scope="col" class="text-center">Created_At</th>
                <th scope="col" class="text-center">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="form-check form-check-primary">
                            <input class="form-check-input" type="checkbox" name="users[]"
                                   value="{{$user->id}}">
                        </div>
                    </td>
                    <td>
                        <div class="media">
                            <div class="avatar me-2">
                                <img alt="avatar" src="{{asset($user->profile_image)}}" class="rounded-circle"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="mb-0">{{$user->name}}</h6>
                                <span class="text-success d-block">{{$user->email}}</span>
                                <span class="text-success d-block">{{$user->phone_number}}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0">{{$user->country??'NULL'}}</p>
                        <span class="text-success">{{$user->address??'NULL'}}</span>
                    </td>
                    <td>
                        <p class="mb-0">{{$user->age??'NULL'}}</p>

                    </td>
                    <td>
                        <p class="mb-0">
                            @if($user->role_as==0)
                                Admin
                            @elseif($user->role_as==1)
                                Coach
                            @elseif($user->role_as==2)
                                Client
                            @endif
                        </p>

                    </td>
                    <td class="text-center">
                        <p class="mb-0">{{\Carbon\Carbon::make($user->created_at)->toDateString()??'NULL'}}</p>
                        <span
                            class="text-success">{{\Carbon\Carbon::make($user->created_at)->toTimeString()??'NULL'}}</span>
                    </td>
                    <td class="cursor-pointer ">
                        <div class="d-flex align-items-center">


                            <div class="action-btns">
                                <a href="{{url('coach/users',$user->id)}}" class="action-btn btn-view bs-tooltip me-2"
                                   data-toggle="tooltip" data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a onclick="prepareusertoedit({{$user->id}})"
                                   href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                   data-placement="top" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                                <a type="button" data-toggle="modal" data-target="#deleteuserModal"
                                   href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                   data-placement="top" title="Delete" onclick="prepareuser({{$user->id}})">
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
        {{$users->links()}}

    </div>

@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            $('#selectAll').click(function () {
                $('[name="users[]"]').prop('checked', this.checked);
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        let userId;
        let price;

        function prepareuser(id) {
            console.log(id)
            userId = id;
        }

        let userIdEdit = 0

        async function prepareusertoedit(id) {

            userIdEdit = id
            const response = await fetch(`/api/users/${id}`, {
                method: 'GET'
            });
            const result = await response.json();
            if (result.status === 200) {

                document.querySelector('#userNameEnEdit').value = result.data.name;
                document.querySelector('#userNameArEdit').value = result.data.name_ar;
                document.querySelector('#userNameKuEdit').value = result.data.name_ku;
                document.querySelector('#userDescriptionEnEdit').value = result.data.description;
                document.querySelector('#userDescriptionArEdit').value = result.data.description_ar;
                document.querySelector('#userDescriptionKuEdit').value = result.data.description_ku;
                document.querySelector('#coverImageEdit').src = `http://gym.test/${result.data.cover_image}`
                $('#edituserModal').modal('show')

            } else if (result.status === 400) {

                console.error(result)

            }
        }

        function closeeditmodal() {
            $('#edituserModal').modal('hide')
        }

        async function deleteuser() {


            if (userId) {
                try {
                    const response = await fetch(`/api/users/${userId}`, {
                        method: 'delete'
                    });

                    const result = await response.json();
                    if (result.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message,
                        })

                        $('#deleteuserModal').modal('hide')
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
                    url: `/api/users/${userId}`,
                    method: 'DELETE',
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: `user ${userId} deleted successfully`,
                            icon: "success",
                            button: "Ok",
                            position: 'center',
                            timer: 3000
                        })

                        $('#deleteuserModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        price = null;
                        userId = null;
                        let messages = error.responseJSON.message
                        // $.each(messages, function(index, value) {
                        //     console.log(`Item at index ${index} is ${value}`);
                        // });

                    }
                });
            } else {
                swal.fire({
                    title: "Error",
                    text: `user Id does not set`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                });
            }
        }


        function deleteSelected() {
            let checkboxes = $('[name="users[]"]:checked');
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
                    url: `/api/users/delete-collection`,
                    method: 'post',
                    data: {'users': selectedValues},
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
                        $('#deleteArrayOfusersModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
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
                    title: "No users selected",
                    text: `select at least one user to delete`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                })
                $('#deleteArrayOfusersModal').modal('hide')
            }


        }

    </script>

    <script>


        const form = document.querySelector('#createuserForm');


        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                const response = await fetch('/api/auth/register', {
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

                    $('#adduserModal').modal('hide')
                    location.reload();
                } else if (result.status === 400) {
                    let message = result.message;
                    let errorMessage = ``;
                    for (const key in message) {
                        errorMessage +=`<span class="text-danger d-block"> ${message[key]}</span>`
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
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const editForm = document.querySelector('#edituserForm');
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formDataEdit = new FormData(editForm);

            try {
                const response = await fetch(`/api/users/${userIdEdit}`, {
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

                    $('#adduserModal').modal('hide')
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
    </script>
@endsection

