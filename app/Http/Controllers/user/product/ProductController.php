<?php

namespace App\Http\Controllers\user\product;

use App\Models\supplement;

class ProductController
{
    function show(supplement $product)
    {
        $relatedProducts=supplement::inRandomOrder()->where('brand_id',$product->brand_id)->where('id','!=',$product->id)->limit(20)->get();
        return view('user.products.show',compact('product','relatedProducts'));
    }
}
