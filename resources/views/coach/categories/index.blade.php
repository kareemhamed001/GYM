@extends('layouts.app-blog-create')

@section('content')

    <div class="modal fade modal-xl" id="editCategoryModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">{!! __('categories.edit') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeeditmodal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="coach_id" value="{{Auth::user()->id}}">


                        <div class="form-group col-6 my-1 ps-2">
                            <label for="coverImage">{!! __('categories.coverImage') !!}</label>
                            <input name="cover_image" class="form-control" type="file" id="coverImage"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="col-6 my-1">
                            <img id="coverImageEdit" style="object-fit: scale-down" class="img-fluid" src="" alt="">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="categoryNameEnEdit">{!! __('categories.nameEn') !!}</label>
                            <input name="name" class="form-control" type="text" id="categoryNameEnEdit"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryNameArEdit">{!! __('categories.nameAr') !!}</label>
                            <input name="name_ar" class="form-control" type="text" id="categoryNameArEdit"
                                   placeholder="Enter name in arabic">
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryNameKuEdit">{!! __('categories.nameKu') !!}</label>
                            <input name="name_ku" class="form-control" type="text" id="categoryNameKuEdit"
                                   placeholder="Enter name in kurdish">
                        </div>
                        <div class="form-group col-12 my-1">
                            <label for="categoryDescriptionEnEdit">{!! __('categories.descriptionEn') !!}</label>
                            <textarea name="description" class="form-control" type="text" id="categoryDescriptionEnEdit"
                                      placeholder="Enter Description in english"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryDescriptionArEdit">{!! __('categories.descriptionAr') !!}</label>
                            <textarea name="description_ar" class="form-control" type="text"
                                      id="categoryDescriptionArEdit"
                                      placeholder="Enter Description in arabic"></textarea>
                        </div>
                        <div class="form-group col-6 px-1 my-1">
                            <label for="categoryDescriptionKuEdit">{!! __('categories.descriptionKu') !!}</label>
                            <textarea name="description_ku" class="form-control" type="text"
                                      id="categoryDescriptionKuEdit"
                                      placeholder="Enter Description in kurdish"></textarea>
                        </div>

                        <hr>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeeditmodal()">
                        {!! __('categories.close') !!}
                    </button>
                    <button type="submit" class="btn btn-primary" form="editCategoryForm">{!! __('categories.save') !!}</button>

                </div>
            </div>
        </div>
    </div>


    <div class="row my-3">

            <h3>{!! __('categories.categories') !!}</h3>


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
                <th  >{!! __('categories.id') !!}</th>
                <th scope="col">{!! __('categories.'.\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale().'') !!}</th>
                <th scope="col" class="text-center">{!! __('categories.createdAt') !!}</th>
                <th scope="col" class="text-center">{!! __('categories.action') !!}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)

                <tr>
                    <td>
                        {{$category->id}}
                    </td>
                    <td>
                        <div class="media">
                            <div class="avatar mx-2">
                                <img alt="" src="{{asset($category->cover_image)}}" class="rounded-circle"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="mb-0">{{$category['name_'.\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale().'']}}</h6>
                                <span class="text-success d-block" style="word-break: break-word">{{Str::substr($category['description_'.\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale().''],0,50)}}... </span>
                            </div>
                        </div>
                    </td>


                    <td class="text-center">
                        <p class="mb-0">{{\Carbon\Carbon::make($category->created_at)->toDateString()??'NULL'}}</p>
                        <span
                            class="text-success">{{\Carbon\Carbon::make($category->created_at)->toTimeString()??'NULL'}}</span>
                    </td>
                    <td class="cursor-pointer  ">
                        <div class="d-flex align-items-center  ">

                            <a onclick="preparecategorytoedit({{$category->id}})"
                               href="javascript:void(0);" class="action-btn btn-edit bs-tooltip m-auto"
                               data-placement="top" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit-2">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                            </a>

                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$categories->links()}}

    </div>

@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            $('#selectAll').click(function () {
                $('[name="categories[]"]').prop('checked', this.checked);
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        let categoryId;
        let price;

        function preparecategory(id) {
            categoryId = id;
        }

        let categoryIdEdit = 0

        async function preparecategorytoedit(id) {

            categoryIdEdit = id
            showLoader();
            const response = await fetch(`/api/categories/${id}`, {
                method: 'GET'
            });
            removeLoader()
            const result = await response.json();
            if (result.status === 200) {

                document.querySelector('#categoryNameEnEdit').value = result.data.name_en;
                document.querySelector('#categoryNameArEdit').value = result.data.name_ar;
                document.querySelector('#categoryNameKuEdit').value = result.data.name_ku;
                document.querySelector('#categoryDescriptionEnEdit').value = result.data.description_en;
                document.querySelector('#categoryDescriptionArEdit').value = result.data.description_ar;
                document.querySelector('#categoryDescriptionKuEdit').value = result.data.description_ku;
                document.querySelector('#coverImageEdit').src = `http://gym.test/${result.data.cover_image}`
                $('#editCategoryModal').modal('show')

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
            $('#editCategoryModal').modal('hide')
        }

    </script>

    <script>

        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const editForm = document.querySelector('#editCategoryForm');
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formDataEdit = new FormData(editForm);


            try {
                showLoader()
                const response = await fetch(`/api/categories/${categoryIdEdit}`, {
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

                    $('#addCategoryModal').modal('hide')
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

