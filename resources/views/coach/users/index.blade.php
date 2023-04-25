@extends('layouts.app-blog-create')

@section('content')

    <!-- Modal -->
{{--    <div class="modal fade" id="deleteuserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">Delete user?</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                     <span class="text-danger">--}}
{{--                        the user will be deleted forever!--}}
{{--                     </span>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">--}}
{{--                        Close--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-danger" onclick="deleteuser()">Delete</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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




    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h3>users</h3>
            <div>
                <button type="button" data-toggle="modal" data-target="#deleteArrayOfusersModal"
                        title="delete selected orders"
                        class="btn btn-danger">Delete
                </button>
                <a type="button" class="btn btn-secondary" href="{{url('coach/users/create')}}">
                    Add
                </a>

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

        // async function deleteuser() {
        //
        //
        //     if (userId) {
        //         try {
        //
        //         $.ajax({
        //             url: `/api/users/${userId}`,
        //             method: 'DELETE',
        //             success: function (response) {
        //                 Swal.fire({
        //                     title: "Success",
        //                     text: `user ${userId} deleted successfully`,
        //                     icon: "success",
        //                     button: "Ok",
        //                     position: 'center',
        //                     timer: 3000
        //                 })
        //
        //                 $('#deleteuserModal').modal('hide')
        //                 location.reload();
        //             },
        //             error: function (error) {
        //                 price = null;
        //                 userId = null;
        //                 let messages = error.responseJSON.message
        //                 // $.each(messages, function(index, value) {
        //                 //     console.log(`Item at index ${index} is ${value}`);
        //                 // });
        //
        //             }
        //         });
        //     } else {
        //         swal.fire({
        //             title: "Error",
        //             text: `user Id does not set`,
        //             icon: "error",
        //             button: "Ok",
        //             position: 'center',
        //             timer: 3000
        //         });
        //     }
        // }


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

@endsection

