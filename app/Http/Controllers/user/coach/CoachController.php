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
}
