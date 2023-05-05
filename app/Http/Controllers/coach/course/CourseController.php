<?php

namespace App\Http\Controllers\coach\course;

use App\classes\course\CourseClass;
use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\video;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses=CourseClass::getAll();
        return view('coach.courses.index',compact('courses'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $videos=video::where('coach_id',1)->get();
        return view('coach.courses.create',compact('videos'));
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
            $course=course::find($id);
            if (!$course){
                return redirect()->back()->with('error','Course not found');
            }
            $videos=video::where('coach_id',1)->get();
            return view('coach.courses.edit',compact('course','videos'));
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
