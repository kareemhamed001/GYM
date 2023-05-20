
@extends('layouts.app-blog-create')
@section('styles')

    <link rel="stylesheet" href="{{asset('assets/src/plugins/src/filepond/filepond.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}">
    <link href="{{asset('assets/src/plugins/src/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/src/plugins/src/sweetalerts2/sweetalerts2.css')}}">
    <link href="{{asset('assets/src/plugins/css/light/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/elements/alert.css')}}">
    <link href="{{asset('assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/plugins/css/light/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/forms/switches.css')}}">
    <link href="{{asset('assets/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/src/assets/css/light/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/plugins/css/dark/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/assets/css/dark/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/elements/alert.css')}}">
    <link href="{{asset('assets/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/plugins/css/dark/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/forms/switches.css')}}">
    <link href="{{asset('assets/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/src/assets/css/dark/users/account-setting.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')


    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <form class="section general-info">
                    <div class="info">
                        <h6 class="">General Information</h6>
                        <div class="row">
                            <div class="col-lg-11 mx-auto">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                        <div class="profile-image  mt-4 pe-md-4">

                                            <!-- // The classic file input element we'll enhance
                                            // to a file pond, we moved the configuration
                                            // properties to JavaScript -->

                                            <div class="img-uploader-content">
                                                <input type="file" class="filepond"
                                                       name="image" src="{{Auth::user()->profile_image}}" accept="image/png, image/jpeg, image/gif"/>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fullName">Full Name</label>
                                                        <input type="text" class="form-control mb-3" id="fullName" placeholder="Full Name" value="Jimmy Turner">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="profession">Profession</label>
                                                        <input type="text" class="form-control mb-3" id="profession" placeholder="Designer" value="Web Developer">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <select class="form-select mb-3" id="country">
                                                            <option>All Countries</option>
                                                            <option selected>United States</option>
                                                            <option>India</option>
                                                            <option>Japan</option>
                                                            <option>China</option>
                                                            <option>Brazil</option>
                                                            <option>Norway</option>
                                                            <option>Canada</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control mb-3" id="address" placeholder="Address" value="New York" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="location">Location</label>
                                                        <input type="text" class="form-control mb-3" id="location" placeholder="Location">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" class="form-control mb-3" id="phone" placeholder="Write your phone number here" value="+1 (530) 555-12121">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control mb-3" id="email" placeholder="Write your email here" value="Jimmy@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="website1">Website</label>
                                                        <input type="text" class="form-control mb-3" id="website1" placeholder="Enter URL">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="customCheck1">
                                                        <label class="form-check-label" for="customCheck1">Make this my default address</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-1">
                                                    <div class="form-group text-end">
                                                        <button class="btn btn-secondary">Save</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

        </div>

    </div>


@endsection
@section('scripts')

    <script src="{{asset('assets/src/plugins/src/filepond/filepond.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/FilePondPluginImageCrop.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/FilePondPluginImageResize.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/FilePondPluginImageTransform.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/notification/snackbar/snackbar.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js')}}"></script>
    <script src="{{asset('assets/src/assets/js/users/account-settings.js')}}"></script>
@endsection

