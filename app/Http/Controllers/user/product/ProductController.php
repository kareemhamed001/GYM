<?php

namespace App\Http\Controllers\user\product;

use App\Models\supplement;

class ProductController
{
    function show(supplement $product)
    {


        return view('user.products.show',compact('product'));
    }
}
