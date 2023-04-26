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
                        <label for="exampleModalInputName2">File Title</label>
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


        <form method="post" enctype="multipart/form-data" id="my-form">
            @csrf
            <input type="hidden" name="coach_id" value="{{Auth::user()->user?->id??1}}">
            <div class="tab-content">
                <div id="tab1" class="tab-pane active">
                    <h3 class="my-2">Course Details</h3>
                    <hr>
                    <div class="form-group my-2">
                        <label for="title">Title EN</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Course Title"
                               value="{{old('title')}}"
                               name="title">
                    </div>
                    <div class="form-group my-2">
                        <label for="title_ar">Title AR</label>
                        <input type="text" class="form-control" id="title_ar"
                               placeholder="Enter Course Title In Arabic *"
                               value="{{old('title_ar')}}"
                               name="title_ar">
                    </div>
                    <div class="form-group my-2">
                        <label for="title_ku">Title AR</label>
                        <input type="text" class="form-control" id="title_ku"
                               placeholder="Enter Course Title In Kurdish *"
                               value="{{old('title_ku')}}"
                               name="title_ku">
                    </div>
                    <div class="form-group my-2">
                        <label for="description">Course Description</label>
                        <textarea type="text" class="form-control" id="description"
                                  placeholder="Enter Course Description in 500 characters"
                                  name="description">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="description_ar">Description AR</label>
                        <textarea type="text" class="form-control" id="description_ar"
                                  placeholder="Enter Course Description in 500 characters"
                                  name="description_ar">{{old('description_ar')}}</textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="description_ku">Description KU</label>
                        <textarea type="text" class="form-control" id="description_ku"
                                  placeholder="Enter Course Description in 500 characters"
                                  name="description_ku">{{old('description_ku')}}</textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            <input id="price" type="number" class="form-control" name="price" value="{{old('price')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="discount">Discount</label>
                            <input id="discount" type="number" class="form-control" name="discount"
                                   value="{{old('discount')}}">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="type">Type</label>
                        <input id="type" type="number" class="form-control" name="type"
                               value="1">
                    </div>

                </div>

                <div id="tab2" class="tab-pane">
                    <h3 class="my-2">Course Media</h3>
                    <hr>

                    <div class="col-12">
                        <div class="row  d-flex justify-content-center my-2">
                            <div class="col-md-6">
                                <img id="preview" class=' w-100 h-100 border-0' style="object-fit: scale-down">
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
                                                               accept="image/gif, image/jpeg, image/png" onchange="previewImage(event)">
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
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-3">Submit</button>
        </form>


    </div>

@endsection
@section('scripts')

    <script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
    <script>

        let accordionId = 1
        let collapseId = 1
        let headingId = 1

        function addTopic() {
            if ($('#exampleModalInputName1').val()) {
                let topicName = $('#exampleModalInputName1').val()
                accordionId++;
                collapseId++;
                headingId++;

                accordionNewId = 'accordionExample' + accordionId

                let html = `
                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample${accordionNewId}">
                    <!-- Item -->
                    <div class="accordion-item mb-3">
                        <h6 class="accordion-header font-base d-flex" id="heading-${headingId}">
                            <button
                                class="accordion-button fw-bold rounded d-sm-flex d-inline-block collapsed"
                                type="button" data-toggle="collapse" href="#collapse-${collapseId}"
                                aria-expanded="true" aria-controls="collapse-${collapseId}">
<i onclick="removeTopic('accordionExample${accordionNewId}')" class="fa fa-remove fa-1x text-danger me-2"></i>

                                ${$('#exampleModalInputName1').val()}


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

        let homeworkTitle = null
        let homeworkDescription = null
        const homeworkTitleElement = document.getElementById('homeWorkTitle');
        const homeworkDescriptionElement = document.getElementById('homeWorkDescription');
        homeworkTitleElement.addEventListener('change', (event) => {
            homeworkTitle = event.target.value
        });
        homeworkDescriptionElement.addEventListener('change', (event) => {
            homeworkDescription = event.target.value
        });

        let targetAccordionBodyId = null
        let topicName = null

        function setTopicName(accordionBodyId, topic) {
            targetAccordionBodyId = accordionBodyId
            topicName = topic
            console.log(topicName)
        }

        let videoIdCounter = 0

        function addVideo() {
            if (videoId && videoTitle) {
                videoIdCounter++
                let html = `
                        <div class="d-flex justify-content-between align-items-center border-bottom my-1" id="video${videoIdCounter}">
                            <div class="position-relative d-flex align-items-center">
                                <a class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                                    <i class="fas fa-play me-0"></i>
                                </a>
                                <div class="d-flex flex-column">
                                    <span class="d-inline-block text-truncate ms-2 mb-0 h5 fw-light ">${videoTitle}</span>
                                     <input type="hidden" name="topics[${topicName}][videos][${videoId}]" value="${videoId}">
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

        let bankIdCounter = 0

        function addHomework() {
            console.log(homeworkDescription)
            if (homeworkTitle && homeworkDescription) {
                bankIdCounter++
                let html = `
                        <div class="d-flex justify-content-between align-items-center border-bottom my-1" id="bank${bankIdCounter}">
                            <div class="position-relative d-flex align-items-center">
                                <a class="">
                                    <i class="fa-light fa-book"></i>
                                </a>
                                <div class="d-flex flex-column">
                                    <span class="d-inline-block text-truncate ms-2 mb-0 h5 fw-light ">${homeworkTitle}</span>
                                    <span class="d-inline-block text-truncate ms-2 mb-0 h5 fw-light ">${homeworkDescription}</span>
                                     <input class="form-control" type="file" name="topics[${topicName}][files][${homeworkTitle},,,${homeworkDescription}]" >
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

        function removeTopic(topicId) {
            document.getElementById(topicId).remove()
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
        const form=document.getElementById('my-form');
        form.addEventListener('submit',async (e)=>{
           e.preventDefault()

           let formData=new FormData(form);

           try {
               showLoader()
               const response=await fetch('/api/courses',{
                   method:'POST',
                   body: formData
               })
               removeLoader()
               const result =await response.json();
               console.log(result)
               if(result.status===200){
                   Swal.fire({
                       icon: 'success',
                       title: 'Success',
                       text: result.message,
                   })

                   location.reload();
               }else if(result.status===400){
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
               }else{
                   Swal.fire({
                       icon: 'error',
                       title: 'Error',
                       text: 'Server Error',
                   })
               }

           }catch (error){
               removeLoader()
               console.error(error);
           }
        });
    </script>
@endsection
