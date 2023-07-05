<?php

namespace App\Http\Controllers\api\supplements;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\category;
use App\Models\product;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SupplementsController extends Controller
{
    function index(Request $request)
    {

        $category = category::find(config('mainCategories.Supplements.id'));
        $brands = brand::all();
        $products = product::where('category_id', $category->id)->paginate(42);
        return $this->apiResponse(['category'=>$category,'brands'=>$brands,'products'=>$products],'success',200);

    }
}
