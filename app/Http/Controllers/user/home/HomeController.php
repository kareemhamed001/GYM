<?php

namespace App\Http\Controllers\user\home;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    function index(){
        $categories=category::all();
        $lang=LaravelLocalization::setLocale();
        return view('user.home.index',compact('categories','lang'));
    }
}
