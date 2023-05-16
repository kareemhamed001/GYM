@extends('layouts.app-blog-create')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! __('brands.deleteBrand') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        {!! __('brands.deleteBrandForever') !!}
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        {!! __('brands.close') !!}
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deletebrand()">{!! __('brands.delete') !!}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteArrayOfbrandsModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! __('brands.deleteSelected') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        {!! __('brands.deleteSelectedForever') !!}
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        {!! __('brands.close') !!}
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deleteSelected()">{!! __('brands.delete') !!}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-xl" id="addBrandModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">{!! __('brands.addNewBrand') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createbrandForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <input type="hidden" name="coach_id" value="{{Auth::user()?->id}}">
                        <div class="form-group col-12 my-1">
                            <label for="coverImage">{!! __('brands.coverImage') !!}</label>
                            <input name="cover_image" class="form-control" type="file" id="coverImage">
                        </div>
                        <div class="form-group col-md-4 col-12 my-1">
                            <label for="brandNameEn">{!! __('brands.nameEn') !!}</label>
                            <input name="name" class="form-control" type="text" id="brandNameEn"
                                   placeholder="{!! __('brands.enterNameEn') !!}">
                        </div>
                        <div class="form-group col-md-4 col-12 px-1 my-1">
                            <label for="brandNameAr">{!! __('brands.nameAr') !!}</label>
                            <input name="name_ar" class="form-control" type="text" id="brandNameAr"
                                   placeholder="{!! __('brands.enterNameAr') !!}">
                        </div>
                        <div class="form-group col-md-4 col-12 px-1 my-1">
                            <label for="brandNameKu">{!! __('brands.nameKu') !!}</label>
                            <input name="name_ku" class="form-control" type="text" id="brandNameKu"
                                   placeholder="{!! __('brands.enterNameKu') !!}">
                        </div>
                        <div class="form-group col-md-4 col-12 my-1">
                            <label for="brandDescriptionEn">{!! __('brands.descriptionEn') !!}</label>
                            <textarea name="description" class="form-control" type="text" id="brandDescriptionEn"
                                      placeholder="{!! __('brands.enterDescriptionEn') !!}"></textarea>
                        </div>
                        <div class="form-group col-md-4 col-12 px-1 my-1">
                            <label for="brandDescriptionAr">{!! __('brands.descriptionAr') !!}</label>
                            <textarea name="description_ar" class="form-control" type="text" id="brandDescriptionAr"
                                      placeholder="{!! __('brands.enterDescriptionAr') !!}"></textarea>
                        </div>
                        <div class="form-group col-md-4 col-12 px-1 my-1">
                            <label for="brandDescriptionKu">{!! __('brands.descriptionKu') !!}</label>
                            <textarea name="description_ku" class="form-control" type="text" id="brandDescriptionKu"
                                      placeholder="{!! __('brands.enterDescriptionKu') !!}"></textarea>
                        </div>
                        <hr>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{!! __('brands.close') !!}</button>
                    <button type="submit" class="btn btn-primary" form="createbrandForm">{!! __('brands.save') !!}</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="editbrandModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">{!! __('brands.edit') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeeditmodal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editbrandForm" class="d-flex flex-wrap" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="coach_id" value="{{Auth::user()?->id??1}}">
                        <div class="col-6 ">
                            <img id="coverImageEdit" style="object-fit: scale-down" class="img-fluid" src="" alt="">
                        </div>

                        <div class="form-group col-6 my-1 px-2">
                            <label for="coverImage">{!! __('brands.coverImage') !!}</label>
                            <input name="cover_image" class="form-control" type="file" id="coverImage"
                                   placeholder="Enter name in english">
                        </div>
                        <div class="form-group col-md-4 col-12 my-2">
                            <label for="brandNameEnEdit">{!! __('brands.nameEn') !!}</label>
                            <input name="name" class="form-control" type="text" id="brandNameEnEdit"
                                   placeholder="{!! __('brands.enterNameEn') !!}">
                        </div>
                        <div class="form-group col-md-4 col-12 px-2 my-1">
                            <label for="brandNameArEdit">{!! __('brands.nameAr') !!}</label>
                            <input name="name_ar" class="form-control" type="text" id="brandNameArEdit"
                                   placeholder="{!! __('brands.enterNameAr') !!}">
                        </div>
                        <div class="form-group col-md-4 col-12 px-2 my-1">
                            <label for="brandNameKuEdit">{!! __('brands.nameKu') !!}</label>
                            <input name="name_ku" class="form-control" type="text" id="brandNameKuEdit"
                                   placeholder="{!! __('brands.enterNameKu') !!}">
                        </div>
                        <div class="form-group col-md-4 col-12 my-2">
                            <label for="brandDescriptionEnEdit">{!! __('brands.descriptionEn') !!}</label>
                            <textarea name="description" class="form-control" type="text" id="brandDescriptionEnEdit"
                                      placeholder="{!! __('brands.enterDescriptionEn') !!}"></textarea>
                        </div>
                        <div class="form-group col-md-4 col-12 px-2 my-1">
                            <label for="brandDescriptionArEdit">{!! __('brands.descriptionAr') !!}</label>
                            <textarea name="description_ar" class="form-control" type="text"
                                      id="brandDescriptionArEdit"
                                      placeholder="{!! __('brands.enterDescriptionAr') !!}"></textarea>
                        </div>
                        <div class="form-group col-md-4 col-12 px-2 my-1">
                            <label for="brandDescriptionKuEdit">{!! __('brands.descriptionKu') !!}</label>
                            <textarea name="description_ku" class="form-control" type="text"
                                      id="brandDescriptionKuEdit"
                                      placeholder="{!! __('brands.enterDescriptionKu') !!}"></textarea>
                        </div>
                        <hr>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeeditmodal()">
                        {!! __('brands.close') !!}
                    </button>
                    <button type="submit" class="btn btn-primary" form="editbrandForm"> {!! __('brands.save') !!}</button>

                </div>
            </div>
        </div>
    </div>


    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h3> {!! __('brands.brand') !!}</h3>
            <div>
                <button type="button" data-toggle="modal" data-target="#deleteArrayOfbrandsModal"
                        title="delete selected orders"
                        class="btn btn-danger">{!! __('brands.delete') !!}
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal">
                    {!! __('brands.add') !!}
                </button>

            </div>

        </div>
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
                <th class="checkbox-area" scope="col">
                    <div class="form-check form-check-primary">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                    </div>
                </th>
                <th scope="col">{!! __('brands.id') !!}</th>
                <th scope="col">{!! __('brands.brand') !!}</th>
                <th scope="col" class="text-center">{!! __('brands.createdAt') !!}</th>
                <th scope="col" class="text-center">{!! __('brands.action') !!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>
                        <div class="form-check form-check-primary">
                            <input class="form-check-input" type="checkbox" name="brands[]"
                                   value="{{$brand->id}}">
                        </div>
                    </td>
                    <td>
                        {{$brand->id}}
                    </td>
                    <td>
                        <div class="media">
                            <div class="avatar mx-2">
                                <img alt="" src="{{asset($brand->cover_image)}}" class="rounded-circle"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="mb-0">{{$brand['name_'.\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale().'']}}</h6>
                                <span class="text-success d-block" style="word-break: break-word">{{Str::substr($brand['description_'.\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale().''],0,50)}}</span>
                            </div>
                        </div>
                    </td>

                    <td class="text-center">
                        <p class="mb-0">{{\Carbon\Carbon::make($brand->created_at)->toDateString()??'NULL'}}</p>
                        <span
                            class="text-success">{{\Carbon\Carbon::make($brand->created_at)->toTimeString()??'NULL'}}</span>
                    </td>
                    <td class="cursor-pointer ">
                        <div class="d-flex align-items-center">


                            <div class="action-btns">
                                <a href="{{url('coach/brands',$brand->id)}}" class="action-btn btn-view bs-tooltip me-2"
                                   data-toggle="tooltip" data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a onclick="preparebrandtoedit({{$brand->id}})"
                                   href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                   data-placement="top" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                                <a type="button" data-toggle="modal" data-target="#deleteBrandModal"
                                   href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                   data-placement="top" title="Delete" onclick="preparebrand({{$brand->id}})">
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
        {{$brands->links()}}

    </div>

@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            $('#selectAll').click(function () {
                $('[name="brands[]"]').prop('checked', this.checked);
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        let brandId;
        let price;

        function preparebrand(id) {
            console.log(id)
            brandId = id;
        }

        let brandIdEdit = 0

        async function preparebrandtoedit(id) {

            brandIdEdit = id
            const response = await fetch(`/api/brands/${id}`, {
                method: 'GET'
            });
            const result = await response.json();
            if (result.status === 200) {

                document.querySelector('#brandNameEnEdit').value = result.data.name_en;
                document.querySelector('#brandNameArEdit').value = result.data.name_ar;
                document.querySelector('#brandNameKuEdit').value = result.data.name_ku;
                document.querySelector('#brandDescriptionEnEdit').value = result.data.description_en;
                document.querySelector('#brandDescriptionArEdit').value = result.data.description_ar;
                document.querySelector('#brandDescriptionKuEdit').value = result.data.description_ku;
                document.querySelector('#coverImageEdit').src = `http://gym.test/${result.data.cover_image}`
                $('#editbrandModal').modal('show')

            } else if (result.status === 400) {

                console.error(result)

            }
        }

        function closeeditmodal() {
            $('#editbrandModal').modal('hide')
        }

        async function deletebrand() {


            if (brandId) {
                try {
                    const response = await fetch(`/api/brands/${brandId}`, {
                        method: 'delete'
                    });

                    const result = await response.json();
                    if (result.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message,
                        })

                        $('#deleteBrandModal').modal('hide')
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
                    url: `/api/brands/${brandId}`,
                    method: 'DELETE',
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: `brand ${brandId} deleted successfully`,
                            icon: "success",
                            button: "Ok",
                            position: 'center',
                            timer: 3000
                        })

                        $('#deleteBrandModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        price = null;
                        brandId = null;
                        let messages = error.responseJSON.message
                        // $.each(messages, function(index, value) {
                        //     console.log(`Item at index ${index} is ${value}`);
                        // });

                    }
                });
            } else {
                swal.fire({
                        title: "Error",
                        text: `brand Id does not set`,
                        icon: "error",
                        button: "Ok",
                        position: 'center',
                        timer: 3000
                    });
            }
        }


        function deleteSelected() {
            let checkboxes = $('[name="brands[]"]:checked');
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

                showLoader();
                $.ajax({
                    url: `/api/brands/delete-collection`,
                    method: 'post',
                    data: {'brands': selectedValues},
                    success: function (response) {
                        removeLoader()
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
                        $('#deleteArrayOfbrandsModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        removeLoader()
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
                removeLoader()
                Swal.fire({
                    title: "No brands selected",
                    text: `select at least one brand to delete`,
                    icon: "error",
                    button: "Ok",
                    position: 'center',
                    timer: 3000
                })
                $('#deleteArrayOfbrandsModal').modal('hide')
            }


        }

    </script>

    <script>


        const form = document.querySelector('#createbrandForm');


        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                showLoader();
                const response = await fetch('/api/brands', {
                    method: 'post',
                    body: formData
                });

                removeLoader()
                const result = await response.json();

                if (result.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                    })

                    $('#addBrandModal').modal('hide')
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
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const editForm = document.querySelector('#editbrandForm');
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formDataEdit = new FormData(editForm);

            try {
                showLoader();
                const response = await fetch(`/api/brands/${brandIdEdit}`, {
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

                    $('#addBrandModal').modal('hide')
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

