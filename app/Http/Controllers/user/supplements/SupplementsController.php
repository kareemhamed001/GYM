<?php

namespace App\Http\Controllers\user\supplements;

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
        $lang = LaravelLocalization::setLocale();
        if ($request->brand) {
            $brand = brand::find($request->brand);
            if (!$brand) {
                return redirect()->back()->with('error', 'No brand with this id');
            }
            $products = product::where('category_id', $category->id)->where('brand_id', $brand->id)->paginate(42);
            $brands = brand::limit(20)->get();
            return view('user.store.index', compact('products', 'category', 'brands', 'lang'));
        }
        $brands = brand::all();
        $products = product::where('category_id', $category->id)->paginate(42);
        return view('user.store.index', compact('products', 'brands', 'lang', 'category'));

    }
}
