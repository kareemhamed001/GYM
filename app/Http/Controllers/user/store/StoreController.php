<?php

namespace App\Http\Controllers\user\store;

use App\classes\brand\BrandClass;
use App\classes\supplement\SupplementClass;
use App\Models\brand;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreController
{

    function index(Request $request,$categoryName){
        $lang=LaravelLocalization::setLocale();
        $category=category::find(config('mainCategories.'.$categoryName.'.id'));
        $products=product::where('category_id',$category->id)->paginate(42);
        if ($category->id==config('mainCategories.Supplements.id')){
            if ($request->brand){
                $brand=brand::find($request->brand);
                if (!$brand){
                    return redirect()->back()->with('error','No brand with this id');
                }
                $products=product::where('brand_id',$brand->id)->paginate(42);
                $brands=brand::limit(20)->get();
                return view('user.store.index',compact('products','brands','lang'));
            }
            $brands=brand::all();
            return view('user.store.index',compact('products','brands','lang','category'));
        }

        return view('user.store.index',compact('products','lang','category'));
    }
}
