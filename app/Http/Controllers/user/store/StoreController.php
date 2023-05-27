<?php

namespace App\Http\Controllers\user\store;

use App\classes\brand\BrandClass;
use App\classes\supplement\SupplementClass;
use App\Models\brand;
use App\Models\product;
use Illuminate\Http\Request;

class StoreController
{

    function index(Request $request){
        if ($request->brand){
            $brand=brand::find($request->brand);
            if (!$brand){
                return redirect()->back()->with('error','No brand with this id');
            }
            $products=product::where('brand_id',$brand->id)->paginate(42);
            $brands=brand::limit(20)->get();
            return view('user.store.index',compact('products','brands'));
        }

        $products=product::paginate(42);
        $brands=brand::limit(20)->get();
        return view('user.store.index',compact('products','brands'));
    }
}
