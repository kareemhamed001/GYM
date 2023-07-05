<?php
namespace App\Http\Controllers\api\sportWears;

use App\Models\category;
use App\Models\product;
use App\Models\subCategory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SportWearController
{
    function index(){
        $category=category::find(config('mainCategories.SportWear.id'));

        $subCategories = subCategory::where('category_id', $category->id)->get();
        $products = product::where('category_id', $category->id)->paginate(42);
        return $this->apiResponse(['category'=>$category,'subCategories'=>$subCategories,'products'=>$products],'success',200);
    }
}
