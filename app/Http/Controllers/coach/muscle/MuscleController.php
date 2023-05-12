<?php

namespace App\Http\Controllers\coach\muscle;

use App\classes\muscle\MuscleClass;
use App\Http\Controllers\Controller;
use App\Models\muscle;
use App\Models\video;
use Illuminate\Http\Request;

class MuscleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $muscles=MuscleClass::getAll();
        return view('coach.muscles.index',compact('muscles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coach.muscles.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $muscle=muscle::find($id);
            if (!$muscle){
                return redirect()->back()->with('error','muscle not found');
            }
            return view('coach.muscles.edit',compact('muscle'));
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

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
