<?php

namespace App\Http\Controllers\user\coach;

use App\classes\coach\CoachClass;
use App\Models\coach;

class CoachController
{

    function index(){
        $coaches =CoachClass::getAll(50);
        return view('user.coaches.index',compact('coaches'));
    }

    function show($id){
        try {
            $coach=coach::find($id);
            if (!$coach){
                return redirect()->back()->with('error','This coach is not exists');
            }
            return view('user.coaches.show',compact('coach'));
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
