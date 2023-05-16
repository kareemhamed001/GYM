<?php

namespace App\Http\Controllers\coach\brand;

use App\classes\brand\BrandClass;
use App\classes\category\CategoryClass;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = BrandClass::getAll();
        return view('coach.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
            $brand = brand::find($id);
            $products=product::where('brand_id',$brand->id)->paginate();
            return view('coach.brands.show', compact('brand','products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
