<?php

namespace App\Http\Controllers\api\equipments;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\subCategory;

use App\traits\ApiResponse;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EquipmentController extends Controller
{

    use ApiResponse;
    function index(Request $request){
        $category=category::find(config('mainCategories.Equipments.id'));
        $subCategories = subCategory::where('category_id', $category->id)->get();
        $products = product::where('category_id', $category->id)->paginate(42);

        return $this->apiResponse(['category'=>$category,'subCategories'=>$subCategories,'products'=>$products],'success',200);
    }
}
