<?php

namespace App\Http\Controllers\coach\products;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\category;
use App\Models\product;
use App\Models\subCategory;


class ProductsController extends Controller
{

    function index(category $category){
        $products=product::where('category_id',$category->id)->paginate();

        return view('coach.products.index',compact('category','products'));
    }

    function create(category $category){

        $subcategories=subCategory::where('category_id',$category->id)->get();
        return view('coach.products.create',compact('subcategories','category'));
    }

    function categories(category $category){

        $categories=subCategory::where('category_id',$category->id)->paginate();


        return view('coach.subCategories.index',compact('categories','category'));
    }

    public function edit(category $category,product $id)
    {
        $categories=category::all();
        $brands=brand::all();
        $product=product::find($id);
        return view('coach.products.edit',compact('product','brands','categories'));
    }
}
