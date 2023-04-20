<?php

namespace App\Http\Controllers\user\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        return view('user.home.index');
    }
}
