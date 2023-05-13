<?php

namespace App\Http\Controllers\user\product;

use App\Models\product;

class ProductController
{
    function show(product $product)
    {
        $relatedProducts=product::inRandomOrder()->where('brand_id',$product->brand_id)->where('id','!=',$product->id)->limit(20)->get();
        return view('user.products.show',compact('product','relatedProducts'));
    }
}
