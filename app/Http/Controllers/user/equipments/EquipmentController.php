<?php

namespace App\Http\Controllers\user\equipments;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\subCategory;

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EquipmentController extends Controller
{

    function index(Request $request){
        $category=category::find(config('mainCategories.Equipments.id'));
        $lang=LaravelLocalization::setLocale();
        if ($request->subcategory) {
            $subCategory = subCategory::where('id', $request->subcategory)->first();
            if ($subCategory->count() == 0) {
                return redirect()->back()->with('error', 'No category with this id');
            }
            $products = product::where('category_id',$category->id)->where('subcategory_id', $subCategory->id)->paginate(42);
            $subCategories = subCategory::where('category_id', $category->id)->get();
            return view('user.store.index', compact('products', 'category', 'subCategories', 'lang'));
        }
        $subCategories = subCategory::where('category_id', $category->id)->get();
        $products = product::where('category_id', $category->id)->paginate(42);
        return view('user.store.index',compact('category','lang','subCategories','products'));
    }
}
