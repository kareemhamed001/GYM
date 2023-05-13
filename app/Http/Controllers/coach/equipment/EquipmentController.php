<?php

namespace App\Http\Controllers\coach\equipment;

use App\classes\category\CategoryClass;
use App\classes\supplement\SupplementClass;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\category;
use App\Models\subCategory;
use App\Models\product;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=SupplementClass::getAll();
        return view('coach.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=category::all();
        $brands=brand::all();
        return view('coach.products.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product=product::find($id);
            if (!$product){
                return redirect()->back()->with('error','No product with this id');
            }
            return view('coach.products.show',compact('product'));
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=category::all();
        $brands=brand::all();
        $product=product::find($id);
        return view('coach.products.edit',compact('product','brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
