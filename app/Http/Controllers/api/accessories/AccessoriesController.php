<?php

namespace App\Http\Controllers\api\accessories;

use App\Models\category;
use App\Models\product;
use App\Models\subCategory;

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AccessoriesController
{

    function index(Request $request){
        $category=category::find(config('mainCategories.Accessories.id'));
        $subCategories = subCategory::where('category_id', $category->id)->get();
        $products = product::where('category_id', $category->id)->paginate(42);
        return $this->apiResponse(['category'=>$category,'subCategories'=>$subCategories,'products'=>$products],'success',200);
    }
}
