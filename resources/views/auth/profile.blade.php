@extends('layouts.app-blog-create')

@section('content')

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <form id="editUserForm" class="my-2 row">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{Auth::user()?->id}}">
                    <div class="col-12 d-flex justify-content-center">
                        <label for="coverImage">
                            <img id="preview" class="img-fluid col-6 rounded-circle border border-white"
                                 style="width: 18rem ;height: 18rem;object-fit: scale-down"
                                 src="{{asset($user->profile_image)}}" alt="">
                        </label>

                    </div>
                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="role_as" class="form-label">Role</label>
                        <input class="form-control disabled" id="role_as" value="{{$user->role_as==1?'Coach':'User'}}"
                               disabled>

                    </div>


                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="coverImage">Profile Image</label>
                        <input name="profile_image" class="form-control" type="file" id="coverImage"
                               onchange="previewImage(event)">
                        @error('profile_image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="userNameEn">Name</label>
                        <input name="name" class="form-control" type="text" id="userNameEn"
                               placeholder="Enter user name *" value="{{$user->name}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="coachemail">Email</label>
                        <input class="form-control" type="email" id="coachemail"
                               placeholder="Enter valid email *" value="{{$user->email}}">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="phone_number">phone number</label>
                        <input name="phone_number" class="form-control" type="text" id="phone_number"
                               placeholder="Enter valid phone number *" value="{{$user->phone_number}}">
                        @error('phone_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="password">password</label>
                        <input name="password" class="form-control" type="password" id="password"
                               placeholder="Enter password *">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="country">country</label>
                        <input name="country" class="form-control" type="text" id="country"
                               placeholder="Enter user country *" value="{{$user->country}}">
                        @error('country')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="address">address</label>
                        <input type="text" name="address" id="address" class="form-control"
                               placeholder="Enter user address *" value="{{$user->address}}">
                        @error('address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="age">age</label>
                        <input name="age" class="form-control" type="text" id="age"
                               placeholder="Enter user age *" value="{{$user->age}}">
                        @error('age')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 my-2 px-1">
                        <label for="gender">gender</label>
                        <select name="gender" class="form-control" type="text" id="gender" onchange="">

                            <option value="0" @if($user->role_as==0) selected @endif>Male</option>
                            <option value="1" @if($user->role_as==1) selected @endif>Female</option>
                        </select>
                        @error('gender')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    @if($user->role_as==1)

                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="nick_name">nick name</label>
                            <input name="coach_nick_name" class="form-control" type="text" id="nick_name"
                                   placeholder="Enter coach nick name *" value="{{$user->coach?->nick_name}}">
                            @error('coach_nick_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="email">Email</label>
                            <input name="coach_email" class="form-control" type="email" id="email"
                                   placeholder="Enter coach email *" value="{{$user->coach?->email}}">
                            @error('coach_email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="description">description</label>
                            <input name="coach_description" class="form-control" type="text" id="description"
                                   placeholder="Enter coach description *" value="{{$user->coach?->description}}">
                            @error('coach_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="phone_number">phone number</label>
                            <input name="coach_phone_number" class="form-control" type="text" id="phone_number"
                                   placeholder="Enter coach phone number *" value="{{$user->coach?->phone_number}}">
                            @error('coach_phone_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="experience">experience</label>
                            <input name="coach_experience" class="form-control" type="text" id="experience"
                                   placeholder="Enter coach experience *" value="{{$user->coach?->experience}}">
                            @error('coach_experience')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 my-2 px-1">
                            <label for="coach_intro_video">intro video</label>
                            <input name="coach_intro_video" class="form-control" type="file" id="coach_intro_video"
                                   placeholder="Coach intro video *">
                            @error('coach_intro_video')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    @endif

                    <div class="col-12 my-2 px-1">

                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>

        </div>


        @endsection
        @section('scripts')

            <script>
                let form = document.getElementById('editUserForm');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    try {
                        showLoader();
                        let response = await fetch('/coach/update-profile', {
                            method: 'post',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: new FormData(form)
                        });

                        removeLoader()
                        let result =await response.json();
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Updated Successfully',
                            })

                        } else if (result.status === 400) {
                            let message = result.message;
                            let errorMessage = ``;
                            if (Array.isArray(message)) {
                                for (const key in message) {
                                    errorMessage += `<span class="d-block text-danger">${message[key]}</span> `
                                }
                            } else {
                                errorMessage = message;
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
            </script>
@endsection

