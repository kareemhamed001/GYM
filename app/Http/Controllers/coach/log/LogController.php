<?php

namespace App\Http\Controllers\coach\log;

use App\Http\Controllers\Controller;
use App\Models\log;

class LogController extends Controller
{
    function index(){
        $logs=log::paginate();
        return view('coach.logs.index',compact('logs'));
    }
}
