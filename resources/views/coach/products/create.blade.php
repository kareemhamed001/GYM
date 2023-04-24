@extends('layouts.app-blog-create')
@section('content')
    <div class="row my-2">

        <nav class="breadcrumb-style-one mb-3  col-lg-6" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('coach')}}">Coach</a></li>
                <li class="breadcrumb-item"><a href="{{url('coach/products')}}">brands</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create product</li>
            </ol>
        </nav>
        <h4 class="my-3">Add Product</h4>
        <img id="preview">
        <form id="addProductForm" class="my-2">
            @csrf
            <input type="hidden" name="coach_id" value="{{\Illuminate\Support\Facades\Auth::user()?->id??1}}">
            <div class="row">
                <div class="my-1 col-md-6">
                    <label for="cover_image">Cover_image</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="my-1 col-md-6">
                    <label for="brand_id">Brand</label>
                    <select  class="form-select" id="brand_id" name="brand_id" >
                        <option value="">--select brand--</option>
                        @foreach(\App\Models\brand::all() as $brand)

                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-1 col-12">
                    <label for="name_en">Name En</label>
                    <input type="text" class="form-control" id="name_en" name="name"
                           placeholder="Product Name In English *">
                </div>
                <div class="my-1 col-md-6">
                    <label for="name_ar">Name Ar</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                           placeholder="Product Name In Arabic *">
                </div>
                <div class="my-1 col-md-6">
                    <label for="name_ku">Name Ku</label>
                    <input type="text" class="form-control" id="name_ku" name="name_ku"
                           placeholder="Product Name In Kurdish *">
                </div>
                <div class="my-1 col-12">
                    <label for="description_en">Description En</label>
                    <textarea type="text" class="form-control" id="description_en" name="description"
                           placeholder="Product Description In English *"></textarea>
                </div>
                <div class="my-1 col-md-6">
                    <label for="description_ar">Description Ar</label>
                    <textarea type="text" class="form-control" id="description_ar" name="description_ar"
                           placeholder="Product Description In Arabic *"></textarea>
                </div>
                <div class="my-1 col-md-6">
                    <label for="description_ku">Description Ku</label>
                    <textarea type="text" class="form-control" id="description_ku" name="description_ku"
                           placeholder="Product Description In Kurdish *"></textarea>
                </div>
                <div class="my-1 col-6">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"
                           placeholder="Product Description In Kurdish *">
                </div>
                <div class="my-1 col-6">
                    <label for="unit">Unit(EX.KG)</label>
                    <input type="text" class="form-control" id="unit" name="unit"
                           placeholder="Unit of product *">
                </div>
                <div class="my-1 col-6">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price"
                           placeholder="Price *">
                </div>
                <div class="my-1 col-6">
                    <label for="discount">Discount</label>
                    <input type="text" class="form-control" id="discount" name="discount"
                           placeholder="Discount in percent *">
                </div>
            </div>
            <div class="my-1">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </form>
    </div>

@endsection
@section('scripts')
    <script>
        let form= document.querySelector('#addProductForm')

        form.addEventListener('submit',async (e)=>{
          e.preventDefault();
          let formData=new FormData(form)
            try {
              let response =await fetch('/api/products',{
                  method:'post',
                  body:formData
              });

              let result=await response.json();

                console.log(result)
              if (result.status===200){
                      Swal.fire({
                          icon: 'success',
                          title: 'Success',
                          text: result.message,
                      })
              }else if(result.status===400){
                  let message = result.message;
                  let errorMessage = ``;
                  for (const key in message) {
                      errorMessage +=`<span class="text-danger d-block"> ${message[key]}</span> \n`
                  }
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      html: errorMessage,
                  })
              }

            }catch(error){
                console.error(error)
            }
        });


    </script>
@endsection
