@extends('layouts.app-blog-create')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/widgets/modules-widgets.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/widgets/modules-widgets.css')}}">
@endsection
@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add part</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleModalInputName1">part Name</label>
                        <input type="text" class="form-control" id="exampleModalInputName1"
                               placeholder="Enter part name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addpart()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="addVideoModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Home work</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="homeWorkTitle">File Title</label>
                        <input type="text" class="form-control" id="homeWorkTitle">
                    </div>
                    <div class="form-group">
                        <label for="exampleModalInputName3">File Description</label>
                        <input type="text" class="form-control" id="homeWorkDescription">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addHomework()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('coach')}}">coach</a></li>
                <li class="breadcrumb-item"><a href="{{url('coach/muscles')}}">muscles</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$muscle->title}}</li>
            </ol>
        </nav>

        <h3><i class="fa-light fa-graduation-cap"></i>
            Edit muscle
        </h3>
    </div>
    <div class="row" id="innerBody">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @forelse ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @empty
                    @endforelse
                </ul>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success col-12" role="alert">
                {{session('success')}}
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-success col-12" role="alert">
                {{session('error')}}
            </div>
        @endif
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#tab1" class="nav-link active" data-toggle="tab">muscle Details</a>
            </li>
            <li class="nav-item">
                <a href="#tab2" class="nav-link" data-toggle="tab">muscle Media</a>
            </li>
            <li class="nav-item">
                <a href="#tab3" class="nav-link" data-toggle="tab">Content</a>
            </li>

        </ul>


        <form id="my-form">
            @csrf
            @method('PUT')
            <input type="hidden" name="coach_id" value="{{Auth::user()->user?->id??1}}">
            <div class="tab-content">
                <div id="tab1" class="tab-pane active">
                    <h3 class="my-2">muscle Details</h3>
                    <hr>
                    <div class="form-group my-2">
                        <label for="title">Title EN</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter muscle Title"
                               value="{{$muscle->title_en}}"
                               name="title">
                    </div>
                    <div class="form-group my-2">
                        <label for="title_ar">Title AR</label>
                        <input type="text" class="form-control" id="title_ar"
                               placeholder="Enter muscle Title In Arabic *"
                               value="{{$muscle->title_ar}}"
                               name="title_ar">
                    </div>
                    <div class="form-group my-2">
                        <label for="title_ku">Title Ku</label>
                        <input type="text" class="form-control" id="title_ku"
                               placeholder="Enter muscle Title In Kurdish *"
                               value="{{$muscle->title_ku}}"
                               name="title_ku">
                    </div>
                    <div class="form-group my-2">
                        <label for="description">muscle Description</label>
                        <textarea type="text" class="form-control" id="description"
                                  placeholder="Enter muscle Description in 500 characters"
                                  name="description">{{$muscle->description_en}}</textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="description_ar">Description AR</label>
                        <textarea type="text" class="form-control" id="description_ar"
                                  placeholder="Enter muscle Description in 500 characters"
                                  name="description_ar">{{$muscle->description_ar}}</textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="description_ku">Description KU</label>
                        <textarea type="text" class="form-control" id="description_ku"
                                  placeholder="Enter muscle Description in 500 characters"
                                  name="description_ku">{{$muscle->description_ku}}</textarea>
                    </div>



                </div>

                <div id="tab2" class="tab-pane">
                    <h3 class="my-2">muscle Media</h3>
                    <hr>

                    <div class="col-12">
                        <div class="row  d-flex justify-content-center my-2">
                            <div class="col-md-6">
                                <img src="{{asset($muscle->cover_image)}}" id="preview" class=' w-100 h-100 border-0'
                                     style="object-fit: scale-down">
                            </div>
                        </div>

                        <div
                            class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                            <!-- Image -->
                            <i class="fa fa-image fa-4x text-primary"></i>
                            <div>
                                <h6 class="my-2">Upload muscle image here, or<a class="text-primary">
                                        Browse</a></h6>
                                <label style="cursor:pointer;">
													<span>
														<input class="form-control stretched-link" type="file"
                                                               name="cover_image" id="image"
                                                               accept="image/gif, image/jpeg, image/png"
                                                               onchange="previewImage(event)">
													</span>
                                </label>
                                <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab-pane">
                    <h3 class="my-2">Content</h3>
                    <hr>
                    <div class="d-flex justify-content-end my-2">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal"
                                type="button"><i
                                class="fa fa-plus-circle"></i> Add part
                        </button>
                    </div>
                    <div>
                        @forelse($muscle->curricula as $curriculum)


                            <div class="widget widget-table-one my-3" id="curriculum{{$curriculum->id}}">
                                <div class="widget-heading">
                                    <h5 class="d-flex align-items-center">
                                        <a class="me-2" target="_blank" href="{{asset($curriculum->cover_image)}}"><img
                                                class="img-fluid  "
                                                style="object-fit: scale-down ;height: 50px;width: 50px;border-radius: 50%"
                                                src="{{asset($curriculum->cover_image)}}"></a>
                                         part : {{$curriculum->title}}</h5>
                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle show" href="#" role="button" id="transactions"
                                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </a>

                                            <div class="dropdown-menu left show" aria-labelledby="transactions"
                                                 style="will-change: transform; position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 22px, 0px);"
                                                 data-popper-placement="bottom-start">
                                                <a class="dropdown-item "
                                                   onclick="removepart({{$muscle->id}},{{$curriculum->id}},'curriculum{{$curriculum->id}}')"><i
                                                        class="fa fa-trash text-danger "></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="widget-content">
                                    <div class="row">

                                        <input class="text-truncate form-control  mb-0 h5 fw-light " type="hidden"
                                               name="parts[{{$curriculum->title}}][id]" value="{{$curriculum->id}}"
                                               required>


                                        <div class="form-group col-md-6 my-2">
                                            <label for="part{{$curriculum->id}}title">Title</label>
                                            <input class="text-truncate form-control  mb-0 h5 fw-light " type="text"
                                                   id="part{{$curriculum->id}}title"
                                                   name="parts[{{$curriculum->title}}][title]"
                                                   value="{{$curriculum->title}}" required>
                                        </div>
                                        <div class="form-group col-md-6 my-2">
                                            <label for="part{{$curriculum->id}}coverImage">Cover Image</label>
                                            <input class="form-control" type="file"
                                                   id="part{{$curriculum->id}}coverImage"
                                                   name="parts[{{$curriculum->title}}][cover_image]">
                                        </div>


                                        <div class="accordion-body mt-3" id="curriculum{{$curriculum->id}}Body">

                                            @forelse($curriculum->files as $file)

                                                    <div class="" id="file{{$file->id}}">

                                                        <hr>
                                                        <div class="d-flex justify-content-between my-2">
                                                            <h5>File:{{$file->title}}</h5>
                                                            <p class="mb-0 w-auto">
                                                                <button onclick="removeFile({{$muscle->id}},{{$curriculum->id}},{{$file->id}},'file{{$file->id}}')"
                                                                        class=" btn btn-danger "
                                                                        type="button"
                                                                        title="Delete File"
                                                                >
                                                                    <i class="fa-light fa-trash"></i>

                                                                    Delete

                                                                </button>
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6 my-2">

                                                                <input
                                                                    class="text-truncate form-control  mb-0 h5 fw-light "
                                                                    type="hidden"
                                                                    name="parts[{{$curriculum->title}}][files][file{{$file->id}}][id]"
                                                                    value="{{$file->id}}">

                                                                <label>Title</label>
                                                                <input
                                                                    class="text-truncate form-control  mb-0 h5 fw-light "
                                                                    name="parts[{{$curriculum->title}}][files][file{{$file->id}}][title]"
                                                                    value="{{$file->title}}" required>
                                                            </div>
                                                            <div class="form-group col-md-6 my-2">
                                                                <label>Description</label>
                                                                <input
                                                                    class="text-truncate form-control  mb-0 h5 fw-light "
                                                                    name="parts[{{$curriculum->title}}][files][file{{$file->id}}][description]"
                                                                    value="{{$file->description}}" required>
                                                            </div>
                                                            <div class="form-group col-md-6 my-2">
                                                                <label>File</label>
                                                                <input class="form-control" type="file"
                                                                       name="parts[{{$curriculum->title}}][files][file{{$file->id}}][file]"
                                                                       accept="application/pdf,image/*,video/*">
                                                            </div>
                                                        </div>
                                                    </div>

                                            @empty
                                            @endforelse
                                        </div>
                                        <button
                                            onclick="addFile('curriculum{{$curriculum->id}}Body','{{$curriculum->title}}')"
                                            type="button"
                                            class="btn btn-sm btn-primary my-2">
                                            <i class="fa fa-plus-circle"></i> Add File
                                        </button>


                                    </div>

                                </div>
                            </div>

                        @empty
                        @endforelse
                    </div>
                </div>
                <button type="submit" class="btn btn-success my-3">Update
                </button>
            </div>
        </form>
    </div>

@endsection
@section('scripts')

    <script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
    <script>

        @if(isset($curriculum))

            let partsCounter = {{$curriculum->id+1}};

            @if(isset($file))
                let filesCounter = {{$file->id+1}};
            @else
                let filesCounter = 0;
            @endif

        @else
            let partsCounter = 0;
            let filesCounter = 0;
        @endif


        function addpart() {
            if ($('#exampleModalInputName1').val()) {
                let partName = $('#exampleModalInputName1').val()
                partsCounter++;

                let html = `
                <div class="widget widget-table-one my-3" id="curriculum${partsCounter}">
                                <div class="widget-heading">
                                    <h5 class="d-flex align-items-center">
                                        part:${partName}</h5>
                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle show" href="#" role="button" id="transactions"
                                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </a>

                                            <div class="dropdown-menu left show" aria-labelledby="transactions"
                                                 style="will-change: transform; position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 22px, 0px);"
                                                 data-popper-placement="bottom-start">
                                                <a class="dropdown-item "
                                                   onclick="removepart('','','curriculum${partsCounter}')"><i
                                                        class="fa fa-trash text-danger "></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="widget-content">
                                    <div class="row">
                                        <div class="form-group col-md-6 my-2">
                                            <label for="part${partsCounter}title">Title</label>
                                            <input class="text-truncate text-muted form-control  mb-0 h5 fw-light " type="text"
                                                   id="part${partsCounter}title"

                                                   required value="${partName}" disabled>
                                            <input class="text-truncate text-muted form-control  mb-0 h5 fw-light " type="hidden"
                                                   id="part${partsCounter}title"
                                                   name="parts[${partName}][title]"
                                                   required value="${partName}" >
                                        </div>
                                        <div class="form-group col-md-6 my-2">
                                            <label for="part${partsCounter}coverImage">Cover Image</label>
                                            <input class="form-control" type="file"
                                                   id="part${partsCounter}coverImage"
                                                   name="parts[${partName}][cover_image]" required>
                                        </div>


                                        <div class="accordion-body mt-3" id="curriculum${partsCounter}Body">

                                        </div>

                                        <button
                                            onclick="addFile('curriculum${partsCounter}Body','${partName}')"
                                            type="button"
                                            class="btn btn-sm btn-primary my-2" >
                                            <i class="fa fa-plus-circle"></i> Add File
                                        </button>


                                    </div>

                                </div>
                            </div>

`
                $('#tab3').append(html)
                $('#exampleModal').modal('hide')
            } else {
                Swal.fire({
                    position: 'top',
                    icon: 'error',
                    title: 'Please enter part name',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

        }


        function addFile(targetParent, partName) {


            filesCounter++;
            let html = `
                        <div class="" id="file${filesCounter}">

                            <hr>
                            <div class="d-flex justify-content-between my-2">
                                <h5>New File</h5>
                                <p class="mb-0 w-auto">
                                    <button onclick="removeFile('','','','file${filesCounter}')"
                                            class=" btn btn-danger  "
                                            type="button"
                                            title="Delete File"
                                    >
                                        <i class="fa-light fa-trash"></i>

                                                                    Delete

                                    </button>
                                </p>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 my-2">

                                    <label>Title</label>
                                    <input
                                        class="text-truncate form-control  mb-0 h5 fw-light "
                                        name="parts[${partName}][files][file${filesCounter}][title]"
                                         required>
                                </div>
                                <div class="form-group col-md-6 my-2">
                                    <label>Description</label>
                                    <input
                                        class="text-truncate form-control  mb-0 h5 fw-light "
                                        name="parts[${partName}][files][file${filesCounter}][description]"
                                        required>
                                </div>
                                <div class="form-group col-md-6 my-2">
                                    <label>File</label>
                                    <input class="form-control" type="file"
                                           name="parts[${partName}][files][file${filesCounter}][file]"
                                           accept="application/pdf,image/*,video/*">
                                </div>
                            </div>
                        </div>`
            let targetParentElement = document.getElementById(targetParent)
            targetParentElement.innerHTML += html;
        }
        async function removeFile(muscleId, partId, fileId, parentElement) {

            try {
                if (muscleId && fileId) {
                    let response = await fetch(`/api/muscles/${muscleId}/${partId}/${fileId}/delete-file`, {
                        method: 'post'
                    });
                    let result = await response.json();
                    if (result.status === 200) {
                        document.getElementById(parentElement).remove()
                    }
                } else {
                    document.getElementById(parentElement).remove()
                }

            } catch (error) {
                console.error(error)
            }

        }
        async function removepart(muscleId, partId, parentElement) {
            try {
                if (muscleId && partId) {
                    let response = await fetch(`/api/muscles/${muscleId}/${partId}/delete-curriculum`, {
                        method: 'post'
                    });
                    let result = await response.json();
                    if (result.status === 200) {
                        document.getElementById(parentElement).remove()
                    }
                } else {
                    document.getElementById(parentElement).remove()
                }


            } catch (error) {
                console.error(error)
            }

        }

    </script>
    <script>
        const form = document.getElementById('my-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            let formData = new FormData(form);
            console.log(formData);

            try {
                showLoader()
                const response = await fetch('/api/muscles/{{$muscle->id}}', {
                    method: 'post',
                    body: formData
                })
                removeLoader()

                const result = await response.json();

                console.log(result)
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                    })

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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Server Error',
                    })
                }

            } catch (error) {
                removeLoader()
                console.error(error);
            }
        });
    </script>
@endsection
