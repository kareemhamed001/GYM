@extends('layouts.app-blog-create')
@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleModalInputName1">Topic Name</label>
                        <input type="text" class="form-control" id="exampleModalInputName1"
                               placeholder="Enter topic name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addTopic()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addVideoModal" tabindex="-1" role="dialog" aria-labelledby="addVideoModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleModalInputName1">Video</label>
                        <select type="file" name="video[topic1]" class="form-control" id="videoId">
                            <option></option>
                            @foreach($videos as $video)
                                <option value="{{$video->id}}">{{$video->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addVideo()">Add</button>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addHomework()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('coach')}}">coach</a></li>
                <li class="breadcrumb-item"><a href="{{url('coach/courses')}}">courses</a></li>
                <li class="breadcrumb-item active" aria-current="page">add course</li>
            </ol>
        </nav>

        <h3><i class="fa-light fa-graduation-cap"></i>
            Add Course
        </h3>
    </div>
    <div class="row" id="innerBody">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
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
                <a href="#tab1" class="nav-link active" data-toggle="tab">Course Details</a>
            </li>
            <li class="nav-item">
                <a href="#tab2" class="nav-link" data-toggle="tab">Course Media</a>
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
                    <h3 class="my-2">Course Details</h3>
                    <hr>
                    <div class="form-group my-2">
                        <label for="title">Title EN</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Course Title"
                               value="{{$course->title}}"
                               name="title">
                    </div>
                    <div class="form-group my-2">
                        <label for="title_ar">Title AR</label>
                        <input type="text" class="form-control" id="title_ar"
                               placeholder="Enter Course Title In Arabic *"
                               value="{{$course->title_ar}}"
                               name="title_ar">
                    </div>
                    <div class="form-group my-2">
                        <label for="title_ku">Title AR</label>
                        <input type="text" class="form-control" id="title_ku"
                               placeholder="Enter Course Title In Kurdish *"
                               value="{{$course->title_ku}}"
                               name="title_ku">
                    </div>
                    <div class="form-group my-2">
                        <label for="description">Course Description</label>
                        <textarea type="text" class="form-control" id="description"
                                  placeholder="Enter Course Description in 500 characters"
                                  name="description">{{$course->description}}</textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="description_ar">Description AR</label>
                        <textarea type="text" class="form-control" id="description_ar"
                                  placeholder="Enter Course Description in 500 characters"
                                  name="description_ar">{{$course->description_ar}}</textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="description_ku">Description KU</label>
                        <textarea type="text" class="form-control" id="description_ku"
                                  placeholder="Enter Course Description in 500 characters"
                                  name="description_ku">{{$course->description_ku}}</textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            <input id="price" type="number" class="form-control" name="price"
                                   value="{{$course->price}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="discount">Discount</label>
                            <input id="discount" type="number" class="form-control" name="discount"
                                   value="{{$course->discount}}">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="type">Type</label>
                        <input id="type" type="number" class="form-control" name="type"
                               value="{{$course->type}}">
                    </div>

                </div>

                <div id="tab2" class="tab-pane">
                    <h3 class="my-2">Course Media</h3>
                    <hr>

                    <div class="col-12">
                        <div class="row  d-flex justify-content-center my-2">
                            <div class="col-md-6">
                                <img src="{{asset($course->cover_image)}}" id="preview" class=' w-100 h-100 border-0'
                                     style="object-fit: scale-down">
                            </div>
                        </div>

                        <div
                            class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                            <!-- Image -->
                            <i class="fa fa-image fa-4x text-primary"></i>
                            <div>
                                <h6 class="my-2">Upload course image here, or<a class="text-primary">
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
                                class="fa fa-plus-circle"></i> Add Topic
                        </button>
                    </div>
                    <div>
                        @foreach($course->curricula as $curriculum)
                            <div class="accordion accordion-icon accordion-bg-light"
                                 id="accordionExample{{$curriculum->id}}">


                                <input class="text-truncate form-control  mb-0 h5 fw-light " type="hidden"
                                       name="topics[{{$curriculum->title}}][id]" value="{{$curriculum->id}}" required>

                                <!-- Item -->
                                <div class="accordion-item mb-3">
                                    <h6 class="accordion-header font-base d-flex" id="heading-{{$curriculum->id}}">
                                        <button
                                            class="accordion-button fw-bold rounded d-sm-flex d-inline-block collapsed"
                                            type="button" data-toggle="collapse" href="#collapse-{{$curriculum->id}}"
                                            aria-expanded="true" aria-controls="collapse-{{$curriculum->id}}">
                                            <i onclick="removeTopic({{$course->id}},{{$curriculum->id}},'accordionExample{{$curriculum->id}}')"
                                               class="fa fa-remove fa-1x text-danger me-2"></i>

                                            <input class="text-truncate form-control  mb-0 h5 fw-light " type="text"
                                                   name="topics[{{$curriculum->title}}][title]"
                                                   value="{{$curriculum->title}}" required>
                                            {{--                                            {{$curriculum->title}}--}}
                                            <input class="form-control m-2" type="file"
                                                   name="topics[{{$curriculum->title}}][cover_image]">
                                        </button>
                                    </h6>
                                    <div id="collapse-{{$curriculum->id}}" class="accordion-collapse collapse show"
                                         aria-labelledby="heading-1"
                                         data-bs-parent="#accordionExample{{$curriculum->id}}">
                                        <div class="accordion-body mt-3" id="accordion{{$curriculum->id}}Body">

                                            @foreach($curriculum->files as $file)
                                                @if($file->type==0)
                                                    <div
                                                        class="d-flex justify-content-between align-items-center border-bottom my-1"
                                                        id="video{{$file->id}}">
                                                        <div class="position-relative d-flex align-items-center">

                                                            <div class="d-flex flex-column">

                                                                <input type="hidden"
                                                                       name="topics[{{$curriculum->title}}][files][file{{$file->id}}][type]"
                                                                       value="0">
                                                                <input type="hidden"
                                                                       name="topics[{{$curriculum->title}}][files][file{{$file->id}}][id]"
                                                                       value="{{$file->id}}">

                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input
                                                                        class="text-truncate form-control  mb-0 h5 fw-light "
                                                                        name="topics[{{$curriculum->title}}][files][file{{$file->id}}][title]"
                                                                        value="{{$file->title}}" required>
                                                                    <label>Description</label>
                                                                    <input
                                                                        class="text-truncate form-control  mb-0 h5 fw-light "
                                                                        name="topics[{{$curriculum->title}}][files][file{{$file->id}}][description]"
                                                                        required>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <p class="mb-0">
                                                            <button onclick="removeVideo('video{{$file->id}}')"
                                                                    class=" btn btn-danger btn-sm" type="button"><i
                                                                    class="fa fa-remove"></i></button>
                                                        </p>

                                                    </div>
                                                @elseif($file->type==1)
                                                    <div
                                                        class="d-flex justify-content-between align-items-center border-bottom my-1"
                                                        id="bank{{$file->id}}">
                                                        <div class="position-relative d-flex align-items-center">
                                                            <div class="d-flex flex-column">
                                                                <div class="form-group my-2">

                                                                    <input
                                                                        class="text-truncate form-control  mb-0 h5 fw-light "
                                                                        type="hidden"
                                                                        name="topics[{{$curriculum->title}}][files][file{{$file->id}}][id]"
                                                                        value="{{$file->id}}">

                                                                    <input
                                                                        class="text-truncate form-control  mb-0 h5 fw-light "
                                                                        type="hidden"
                                                                        name="topics[{{$curriculum->title}}][files][file{{$file->id}}][type]"
                                                                        value="1">
                                                                    <label>Title</label>
                                                                    <input
                                                                        class="text-truncate form-control  mb-0 h5 fw-light "
                                                                        name="topics[{{$curriculum->title}}][files][file{{$file->id}}][title]"
                                                                        value="{{$file->title}}" required>
                                                                    <label>Description</label>
                                                                    <input
                                                                        class="text-truncate form-control  mb-0 h5 fw-light "
                                                                        name="topics[{{$curriculum->title}}][files][file{{$file->id}}][description]"
                                                                        value="{{$file->description}}" required>
                                                                    <label>File</label>
                                                                    <input class="form-control" type="file"
                                                                           name="topics[{{$curriculum->title}}][files][file{{$file->id}}][file]"
                                                                           accept="application/pdf,image/*,video/*">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 w-auto">
                                                            <button onclick="removeBank('bank{{$file->id}}')"
                                                                    class=" btn btn-danger btn-sm" type="button"><i
                                                                    class="fa fa-remove"></i></button>
                                                        </p>

                                                    </div>
                                                @endif
                                            @endforeach
                                            <button
                                                onclick="setTopicName('accordion{{{$curriculum->id}}}Body','{{$curriculum->title}}')"
                                                type="button"
                                                class="btn btn-sm btn-primary my-2" data-toggle="modal"
                                                data-target="#addVideoModal">
                                                <i class="fa fa-plus-circle"></i> Add Video
                                            </button>
                                            <button
                                                onclick="setTopicName('accordion{{{$curriculum->id}}}Body','{{$curriculum->title}}')"
                                                type="button"
                                                class="btn btn-sm btn-primary my-2" data-toggle="modal"
                                                data-target="#addFileModal">
                                                <i class="fa fa-plus-circle"></i> Add File
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-3">Submit</button>
        </form>


    </div>

@endsection
@section('scripts')

    <script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
    <script>

        @if(isset($curriculum))
        let accordionId = {{$curriculum->id+1}};
        let collapseId = {{$curriculum->id+1}};
        let headingId = {{$curriculum->id+1}};

        @else
        let accordionId = 0;
        let collapseId = 0;
        let headingId = 0;
        @endif


        function addTopic() {
            if ($('#exampleModalInputName1').val()) {
                let topicName = $('#exampleModalInputName1').val()
                accordionId++;
                collapseId++;
                headingId++;

                accordionNewId = 'accordionExample' + accordionId

                let html = `
                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample${accordionNewId}">
                                <input class="text-truncate form-control  mb-0 h5 fw-light " type="hidden" name="topics[${topicName}][title]" value="${topicName}" required>

                    <!-- Item -->
                    <div class="accordion-item mb-3">
                        <h6 class="accordion-header font-base d-flex" id="heading-${headingId}">
                            <button
                                class="accordion-button fw-bold rounded d-sm-flex d-inline-block collapsed"
                                type="button" data-toggle="collapse" href="#collapse-${collapseId}"
                                aria-expanded="true" aria-controls="collapse-${collapseId}">
                                <i onclick="removeTopic('','','accordionExample${accordionNewId}')" class="fa fa-remove fa-1x text-danger me-2"></i>

                                ${$('#exampleModalInputName1').val()}
                                    <input class="form-control m-2" type="file" name="topics[${topicName}][cover_image]" required>
                            </button>
                        </h6>
                        <div id="collapse-${collapseId}" class="accordion-collapse collapse show"
                             aria-labelledby="heading-1" data-bs-parent="#accordionExample${accordionId}">
                            <div class="accordion-body mt-3" id="accordion${accordionId}Body">

                                <button
                                    onclick="setTopicName('accordion${accordionId}Body','${$('#exampleModalInputName1').val()}')"
                                    type="button"
                                    class="btn btn-sm btn-primary my-2" data-toggle="modal" data-target="#addVideoModal">
                                    <i class="fa fa-plus-circle"></i> Add Video
                                </button>
                                   <button
                                    onclick="setTopicName('accordion${accordionId}Body','${$('#exampleModalInputName1').val()}')"
                                    type="button"
                                    class="btn btn-sm btn-primary my-2" data-toggle="modal" data-target="#addFileModal">
                                    <i class="fa fa-plus-circle"></i> Add File
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`
                $('#tab3').append(html)
                $('#exampleModal').modal('hide')
            } else {
                Swal.fire({
                    position: 'top',
                    icon: 'error',
                    title: 'Please enter topic name',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

        }

        let videoId = null
        let videoTitle = null
        const select = document.getElementById('videoId');
        select.addEventListener('change', (event) => {
            videoId = event.target.value;
            videoTitle = event.target.options[event.target.selectedIndex].textContent
        });

        let homeworkDescription = null
        let homeTitle = null
        const homeworkDescriptionElement = document.getElementById('homeWorkDescription');
        const homeworkTitleElement = document.getElementById('homeWorkTitle');
        homeworkDescriptionElement.addEventListener('change', (event) => {
            homeworkDescription = event.target.value
        });
        homeworkTitleElement.addEventListener('change', (event) => {
            homeTitle = event.target.value
        });

        let targetAccordionBodyId = null
        let topicName = null

        function setTopicName(accordionBodyId, topic) {
            targetAccordionBodyId = accordionBodyId
            topicName = topic
        }

        let videoIdCounter = 0
        let bankIdCounter = 0

        function addVideo() {
            if (videoId && videoTitle) {
                videoIdCounter++
                bankIdCounter++
                let html = `
                        <div class="d-flex justify-content-between align-items-center border-bottom my-1" id="video${videoIdCounter}">
                            <div class="position-relative d-flex align-items-center">

                                <div class="d-flex flex-column">

                                     <input type="hidden" name="topics[${topicName}][files][file${bankIdCounter}][type]" value="0">
                                     <input type="hidden" name="topics[${topicName}][files][file${bankIdCounter}][videoId]" value="${videoId}">

                                        <div class="form-group">
                                            <label>Title</label>
                                            <input class="text-truncate form-control  mb-0 h5 fw-light " name="topics[${topicName}][files][file${bankIdCounter}][title]" value="${videoTitle}"required>
                                            <label>Description</label>
                                            <input class="text-truncate form-control  mb-0 h5 fw-light " name="topics[${topicName}][files][file${bankIdCounter}][description]" required>

                                        </div>

                                </div>
                            </div>
                            <p class="mb-0"><button onclick="removeVideo('video${videoIdCounter}')" class=" btn btn-danger btn-sm" type="button"><i class="fa fa-remove"></i></button></p>

                        </div>
                         `
                let accordionBody = document.getElementById(targetAccordionBodyId)
                accordionBody.innerHTML += html;
                $('#addVideoModal').modal('hide')
            } else {
                Swal.fire({
                    position: 'top',
                    icon: 'error',
                    title: 'Please select a video',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }


        function addHomework() {

            if (homeTitle && homeworkDescription) {
                bankIdCounter++
                let html = `
                        <div class="d-flex justify-content-between align-items-center border-bottom my-1" id="bank${bankIdCounter}">
                            <div class="position-relative d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <div class="form-group my-2">

                                        <input class="text-truncate form-control  mb-0 h5 fw-light " type="hidden" name="topics[${topicName}][files][file${bankIdCounter}][type]" value="1">
                                        <label>Title</label>
                                        <input class="text-truncate form-control  mb-0 h5 fw-light " name="topics[${topicName}][files][file${bankIdCounter}][title]" value="${homeTitle}"required>
                                        <label>Description</label>
                                        <input class="text-truncate form-control  mb-0 h5 fw-light " name="topics[${topicName}][files][file${bankIdCounter}][description]" value="${homeworkDescription}"required>
                                        <label>File</label>
                                        <input class="form-control" type="file" name="topics[${topicName}][files][file${bankIdCounter}][file]" required accept="application/pdf,image/*,video/*" >
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 w-auto"><button onclick="removeBank('bank${bankIdCounter}')" class=" btn btn-danger btn-sm" type="button"><i class="fa fa-remove"></i></button></p>

                        </div>
                         `

                let accordionBody = document.getElementById(targetAccordionBodyId)
                accordionBody.innerHTML += html;
                $('#addFileModal').modal('hide')
            } else {
                Swal.fire({
                    position: 'top',
                    icon: 'error',
                    title: 'Please enter title and description',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }

        function removeVideo(videoId) {
            document.getElementById(videoId).remove()
        }

        function removeBank(bankId) {
            document.getElementById(bankId).remove()
        }

        async function removeTopic(courseId, topicId, parentElement) {
            try {
                if (courseId && topicId) {
                    let response = await fetch(`/api/courses/${courseId}/${topicId}/delete-curriculum`, {
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

        window.addEventListener('beforeunload', () => {
            localStorage.setItem('accordionId', accordionId);
            localStorage.setItem('collapseId', collapseId);
            localStorage.setItem('headingId', headingId);
            localStorage.setItem('videoIdCounter', videoIdCounter);
            localStorage.setItem('bankIdCounter', bankIdCounter);
        });
    </script>
    <script>
        const form = document.getElementById('my-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            let formData = new FormData(form);
            console.log(formData);

            try {
                showLoader()
                const response = await fetch('/api/courses/{{$course->id}}', {
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

                    // location.reload();
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
