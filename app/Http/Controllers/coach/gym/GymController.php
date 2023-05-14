<?php

namespace App\Http\Controllers\coach\gym;

use App\Http\Controllers\Controller;
use App\Models\gym;

class GymController extends Controller
{

    function index(){
        $gyms=gym::paginate();
        return view('coach.gym.index',compact('gyms'));
    }
}
