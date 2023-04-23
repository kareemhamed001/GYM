@extends('layouts.app-blog-create')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/src/stepper/bsStepper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/scrollspyNav.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/src/plugins/css/light/stepper/custom-bsStepper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/scrollspyNav.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/css/dark/stepper/custom-bsStepper.css')}}">
@endsection
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
                        <label for="topicName">Topic Name</label>
                        <input type="text" class="form-control" id="topicName"
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
                        <label for="">Video</label>
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
    {{--    <div class="row my-2">--}}

    {{--        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">--}}
    {{--            <ol class="breadcrumb">--}}
    {{--                <li class="breadcrumb-item"><a href="{{url('coach')}}">Coach</a></li>--}}
    {{--                <li class="breadcrumb-item"><a href="{{url('coach/courses')}}">brands</a></li>--}}
    {{--                <li class="breadcrumb-item active" aria-current="page">Create course</li>--}}
    {{--            </ol>--}}
    {{--        </nav>--}}
    {{--        <h4 class="my-3">Add course</h4>--}}
    {{--        <img id="preview">--}}
    {{--        <form id="addcourseForm" class="my-2">--}}
    {{--            @csrf--}}
    {{--            <input type="hidden" name="coach_id" value="{{\Illuminate\Support\Facades\Auth::user()?->id??1}}">--}}
    {{--            <div class="row">--}}
    {{--                <div class="my-1 col-md-6">--}}
    {{--                    <label for="cover_image">Cover_image</label>--}}
    {{--                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-md-6">--}}
    {{--                    <label for="brand_id">Brand</label>--}}
    {{--                    <select  class="form-select" id="brand_id" name="brand_id" >--}}
    {{--                        <option value="">--select brand--</option>--}}
    {{--                        @foreach(\App\Models\brand::all() as $brand)--}}

    {{--                            <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
    {{--                        @endforeach--}}
    {{--                    </select>--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-12">--}}
    {{--                    <label for="name_en">Name En</label>--}}
    {{--                    <input type="text" class="form-control" id="name_en" name="name"--}}
    {{--                           placeholder="course Name In English *">--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-md-6">--}}
    {{--                    <label for="name_ar">Name Ar</label>--}}
    {{--                    <input type="text" class="form-control" id="name_ar" name="name_ar"--}}
    {{--                           placeholder="course Name In Arabic *">--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-md-6">--}}
    {{--                    <label for="name_ku">Name Ku</label>--}}
    {{--                    <input type="text" class="form-control" id="name_ku" name="name_ku"--}}
    {{--                           placeholder="course Name In Kurdish *">--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-12">--}}
    {{--                    <label for="description_en">Description En</label>--}}
    {{--                    <textarea type="text" class="form-control" id="description_en" name="description"--}}
    {{--                              placeholder="course Description In English *"></textarea>--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-md-6">--}}
    {{--                    <label for="description_ar">Description Ar</label>--}}
    {{--                    <textarea type="text" class="form-control" id="description_ar" name="description_ar"--}}
    {{--                              placeholder="course Description In Arabic *"></textarea>--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-md-6">--}}
    {{--                    <label for="description_ku">Description Ku</label>--}}
    {{--                    <textarea type="text" class="form-control" id="description_ku" name="description_ku"--}}
    {{--                              placeholder="course Description In Kurdish *"></textarea>--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-6">--}}
    {{--                    <label for="quantity">Quantity</label>--}}
    {{--                    <input type="text" class="form-control" id="quantity" name="quantity"--}}
    {{--                           placeholder="course Description In Kurdish *">--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-6">--}}
    {{--                    <label for="unit">Unit(EX.KG)</label>--}}
    {{--                    <input type="text" class="form-control" id="unit" name="unit"--}}
    {{--                           placeholder="Unit of course *">--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-6">--}}
    {{--                    <label for="price">Price</label>--}}
    {{--                    <input type="text" class="form-control" id="price" name="price"--}}
    {{--                           placeholder="Price *">--}}
    {{--                </div>--}}
    {{--                <div class="my-1 col-6">--}}
    {{--                    <label for="discount">Discount</label>--}}
    {{--                    <input type="text" class="form-control" id="discount" name="discount"--}}
    {{--                           placeholder="Discount in percent *">--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="my-1">--}}
    {{--                <button type="submit" class="btn btn-primary">Add</button>--}}
    {{--            </div>--}}

    {{--        </form>--}}
    {{--    </div>--}}

    <div class="row layout-top-spacing" id="cancel-row">

        <div id="wizard_Default" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Default</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="bs-stepper stepper-form-one">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#defaultStep-one">
                                <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Course Details</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#defaultStep-two">
                                <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Course Cover</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#defaultStep-three">
                                <button type="button" class="step-trigger" role="tab">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Course Curriculum</span>
                                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">

                            <form id="createCourseForm" method="post">
                                <div id="defaultStep-one" class="content" role="tabpanel">
                                    <div class="row">


                                        <div class="form-group mb-4">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                   placeholder="Enter Course Title In English *">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="title_ar">Title Ar</label>
                                            <input type="text" class="form-control" id="title_ar" name="title_ar"
                                                   placeholder="Enter Course Title In Arabic *">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="title_ku">Title Ku</label>
                                            <input type="text" class="form-control" id="title_ku" name="title_ku"
                                                   placeholder="Enter Course Title In Kurdish *">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="description">Description </label>
                                            <textarea type="text" class="form-control" id="description"
                                                      name="description"
                                                      placeholder="Enter Course Description In English *"></textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="description_ar">Description AR</label>
                                            <textarea type="text" class="form-control" id="description_ar"
                                                      name="description_ar"
                                                      placeholder="Enter Course Description In Arabic *"></textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="description_ku">Description KU</label>
                                            <textarea type="text" class="form-control" id="description_ku"
                                                      name="description_ku"
                                                      placeholder="Enter Course Description In Kurdish *"></textarea>
                                        </div>

                                        <div class="form-group mb-4 col-md-6">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                   placeholder="Enter Course Price *" min="0">
                                        </div>
                                        <div class="form-group mb-4 col-md-6">
                                            <label for="discount">Discount</label>
                                            <input type="number" class="form-control" id="discount" name="discount"
                                                   placeholder="Enter Course Discount" min="0" max="100">
                                        </div>

                                    </div>
                                    <div class="button-action mt-5">
                                        <button class="btn btn-secondary btn-prev me-3" disabled>Prev</button>
                                        <button class="btn btn-secondary btn-nxt" type="button">Next</button>
                                    </div>
                                </div>
                                <div id="defaultStep-two" class="content" role="tabpanel">

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
                                                               accept="image/gif, image/jpeg, image/png">
													</span>
                                            </label>
                                            <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. </p>
                                        </div>
                                    </div>


                                    <div class="button-action mt-5">
                                        <button class="btn btn-secondary btn-prev me-3" type="button">Prev</button>
                                        <button class="btn btn-secondary btn-nxt" type="button">Next</button>
                                    </div>
                                </div>
                                <div id="defaultStep-three" class="content" role="tabpanel">

                                    <div id="tab3">
                                        <div class="d-flex justify-content-end my-2">
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal"
                                                    type="button"><i
                                                    class="fa fa-plus-circle"></i> Add Topic
                                            </button>
                                        </div>
                                    </div>


                                    <div class="button-action mt-3">
                                        <button class="btn btn-secondary btn-prev me-3" type="button">Prev</button>
                                        <button class="btn btn-success me-3" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/src/plugins/src/stepper/bsStepper.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/stepper/custom-bsStepper.min.js')}}"></script>
    <script>
        window.addEventListener('beforeunload', () => {
            const tab = document.getElementById('tab3');
            localStorage.setItem('last-dom-state-tab3', tab.innerHTML);
        });

        // Retrieve the last DOM state from localStorage
        window.addEventListener('load', () => {
            const lastDomState = localStorage.getItem('last-dom-state-tab3');
            if (lastDomState !== null) {
                const tab = document.getElementById('tab3');
                tab.innerHTML = lastDomState;
            }
        });

        // Retrieve the last DOM state from localStorage
        window.addEventListener('load', () => {
            const lastAccordionId = localStorage.getItem('accordionId');
            const lastCollapseId = localStorage.getItem('collapseId');
            const lastHeadingId = localStorage.getItem('headingId');
            const lastVideoIdCounter = localStorage.getItem('videoIdCounter');
            const lastBankIdCounter = localStorage.getItem('bankIdCounter');



            if (lastAccordionId !== null) {
                accordionId = lastAccordionId;
            }
            if (lastCollapseId !== null) {
                collapseId = lastCollapseId;
            }
            if (lastHeadingId !== null) {
                headingId = lastHeadingId;
            }
            if (lastVideoIdCounter !== null) {
                videoIdCounter = lastVideoIdCounter;
            }
            if (lastBankIdCounter !== null) {
                bankIdCounter = lastBankIdCounter;
            }

        });
    </script>
    <script>

        let accordionId = 1
        let collapseId = 1
        let headingId = 1

        function addTopic() {
            if ( $('#topicName').val() ) {

                let topicName=$('#topicName').val()
                accordionId++;
                collapseId++;
                headingId++;
                console.log(accordionId)

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

                                ${$('#topicName').val()}


                            </button>
                        </h6>
                        <div id="collapse-${collapseId}" class="accordion-collapse collapse show"
                             aria-labelledby="heading-1" data-bs-parent="#accordionExample${accordionId}">
                            <div class="accordion-body mt-3" id="accordion${accordionId}Body">


                                <button
                                    onclick="setTopicName('accordion${accordionId}Body','${$('#topicName').val()}')"
                                    type="button"
                                    class="btn btn-sm btn-primary my-2" data-toggle="modal" data-target="#addVideoModal">
                                    <i class="fa fa-plus-circle"></i> Add Video
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
        const homeworkTitleElement = document.getElementById('homeWorkTitle');
        homeworkTitleElement.addEventListener('change', (event) => {
            homeworkTitle = event.target.value
            console.log(homeworkTitle)
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
            if (homeworkTitle) {
                bankIdCounter++
                let html = `
                        <div class="d-flex justify-content-between align-items-center border-bottom my-1" id="bank${bankIdCounter}">
                            <div class="position-relative d-flex align-items-center">
                                <a class="">
                                    <i class="fa-light fa-book"></i>
                                </a>
                                <div class="d-flex flex-column">
                                    <span class="d-inline-block text-truncate ms-2 mb-0 h5 fw-light ">${homeworkTitle}</span>
                                     <input class="form-control" type="file" name="topics[${topicName}][homeworks][${homeworkTitle}]" >
                                </div>
                            </div>
                            <p class="mb-0 w-auto"><button onclick="removeBank('bank${bankIdCounter}')" class=" btn btn-danger btn-sm" type="button"><i class="fa fa-remove"></i></button></p>

                        </div>
                         `

                let accordionBody = document.getElementById(targetAccordionBodyId)
                accordionBody.innerHTML += html;
                $('#addHomeworkModal').modal('hide')
            } else {
                Swal.fire({
                    position: 'top',
                    icon: 'error',
                    title: 'Please select a homework file and enter title',
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
        let form = document.querySelector('#addcourseForm')

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            let formData = new FormData(form)
            try {
                let response = await fetch('/api/courses', {
                    method: 'post',
                    body: formData
                });

                let result = await response.json();

                console.log(result)
                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                    })
                } else if (result.status === 400) {
                    let message = result.message;
                    let errorMessage = ``;
                    for (const key in message) {
                        errorMessage += `<span class="text-danger d-block"> ${message[key]}</span> \n`
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

        function previewImage(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function () {
                    const preview = document.getElementById("preview");
                    preview.src = reader.result;
                });

                reader.readAsDataURL(file);
            }
        }
    </script>


@endsection
