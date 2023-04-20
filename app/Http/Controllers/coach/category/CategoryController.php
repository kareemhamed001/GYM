<?php

namespace App\Http\Controllers\coach\category;

use App\classes\category\CategoryClass;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=CategoryClass::getAll();
        return view('coach.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        try {
            $category=category::find($id);
            if ($category){
                $brands=brand::join('brands_categories','brands.id','=','brands_categories.brand_id')->where('brands_categories.category_id','=',$category->id)->paginate();
                return view('coach.categories.show',compact('category','brands'));
            }
            return redirect()->back()->with('error','No category with this id');
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
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
