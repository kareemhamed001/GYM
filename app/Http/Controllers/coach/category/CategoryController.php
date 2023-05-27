<?php

namespace App\Http\Controllers\coach\category;

use App\classes\category\CategoryClass;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=category::paginate();
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
                $brands=product::select(\DB::raw('brands.id,brands.coach_id,brands.name,brands.name_ar,brands.name_ku,brands.description,brands.description_ar,brands.description_ku,brands.cover_image'))->join('brands','supplements.brand_id','=','brands.id')->where('supplements.category_id',$category->id)->paginate();

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
