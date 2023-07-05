@extends('layouts.app-blog-create')
@section('content')

    <div class="row py-3">
        <h2 class="fw-bold">
            <i class="fa-regular fa-gear "></i>
            {!! __('sidebar.settings')  !!}
        </h2>
        <div class=" col-12">
            <div class="card">
                <div class="card-header">
                    Logo
                </div>
                <div class="card-media-image">
                    <a href="{{asset($settings->logo_path)}}" class="image-fluid">
                        <img class="w-100 h-100" src="{{asset(\App\Models\SiteSetting::latest()->first()->logo_path)}}"
                             alt="">
                    </a>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeLogo">
                        Change
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 my-3">
            <div class="card">
                <div class="card-header">
                    Info
                </div>

                <div class="card-body">
                    <form action="" id="infoForm">
                        <div class="row">

                            <div class="form-group my-2 col-6">
                                <label for="show_name">Show Name</label>
                                <input type="checkbox" id="show_name" name="show_name" class="form-check-input" @if($settings->show_name)checked @endif>
                            </div>
                            <div class="form-group my-2 col-6">
                                <label for="show_logo">Show Logo</label>
                                <input type="checkbox" id="show_logo" name="show_logo" class="form-check-input" @if($settings->show_logo)checked @endif>
                            </div>

                            <div class="form-group my-2 col-lg-4">
                                <label for="name_en">English Name</label>
                                <input type="text" id="name_en" name="name_en" class="form-control" placeholder="Enter name in english"
                                       value="{{$settings->name_en??''}}">
                            </div>

                            <div class="form-group my-2 col-lg-4">
                                <label for="name_ar">Arabic Name</label>
                                <input type="text" id="name_ar" name="name_ar" class="form-control" placeholder="Enter name in arabic"
                                       value="{{$settings->name_ar??''}}">
                            </div>

                            <div class="form-group my-2 col-lg-4">
                                <label for="name_ku">Kurdish Name</label>
                                <input type="text" id="name_ku" name="name_ku" class="form-control" placeholder="Enter name in kurdish"
                                       value="{{$settings->name_ku??''}}">
                            </div>

                            <div class="form-group my-2 col-lg-4">
                                <label for="description_en">English description</label>
                                <textarea type="text" id="description_en" name="description_en" class="form-control" placeholder="Enter description in english">
                                    {{$settings->description_en??''}}
                                </textarea>
                            </div>

                            <div class="form-group my-2 col-lg-4">
                                <label for="description_ar">Arabic description</label>
                                <textarea type="text" id="description_ar" name="description_ar" class="form-control" placeholder="Enter description in arabic">
                                    {{$settings->description_ar??''}}
                                </textarea>
                            </div>

                            <div class="form-group my-2 col-lg-4">
                                <label for="description_ku">Kurdish description</label>
                                <textarea type="text" id="description_ku" name="description_ku" class="form-control" placeholder="Enter description in kurdish">
                                    {{$settings->description_ku??''}}
                                </textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" form="infoForm">
                        Update
                    </button>
                </div>
            </div>
        </div>

    </div>



    <div class="modal fade" id="changeLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change logo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="logoForm">
                        {{--                        <input type="hidden" name="user" value="{{Auth::user()}}">--}}
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input class="form-control" type="file" name="logo" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="logoForm">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let logoForm = document.getElementById('logoForm');
        logoForm.addEventListener('submit', async (e) => {
            e.preventDefault()
            console.log('sin')
            let formData = new FormData(logoForm);
            showLoader()
            let result = await fetch('/api/settings/logo', {
                method: 'POST',
                body: formData
            })
            $('#exampleModal').modal('hide')
            removeLoader()
            let response = await result.json();
            if (response.status === 200) {

                let message = ''
                if (typeof response.message === 'object') {
                    for (let key in message) {
                        message += `<span class="d-block text-success">${response.message[key]}</span>`
                    }
                } else {
                    message = `<span class="d-block text-success">${response.message}</span>`
                }
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    html: message
                })
                location.reload()
            } else {
                let message = ''
                if (typeof response.message === 'object') {
                    for (let key in message) {
                        message += `<span class="d-block text-danger">${response.message[key]}</span>`
                    }
                } else {
                    message = `<span class="d-block text-danger">${response.message}</span>`
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: message
                })

            }
        })
    </script>
    <script >
        let infoForm = document.getElementById('infoForm');
        infoForm.addEventListener('submit', async (e) => {
            e.preventDefault()
            console.log('sin')
            let formData = new FormData(infoForm);
            showLoader()
            let result = await fetch('/api/settings/info', {
                method: 'POST',
                body: formData
            })

            removeLoader()
            let response = await result.json();
            if (response.status === 200) {

                let message = ''
                if (typeof response.message === 'object') {
                    for (let key in message) {
                        message += `<span class="d-block text-success">${response.message[key]}</span>`
                    }
                } else {
                    message = `<span class="d-block text-success">${response.message}</span>`
                }
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    html: message
                })
                location.reload()
            } else {
                let message = ''
                if (typeof response.message === 'object') {
                    for (let key in message) {
                        message += `<span class="d-block text-danger">${response.message[key]}</span>`
                    }
                } else {
                    message = `<span class="d-block text-danger">${response.message}</span>`
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: message
                })

            }
        })
    </script>
@endsection
