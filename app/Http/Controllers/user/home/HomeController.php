<?php

namespace App\Http\Controllers\user\home;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    function index(){
        $categories=category::all();
        $lang=LaravelLocalization::setLocale();
        $products=product::query()->latest('created_at')->limit(8)->get();
        $settings=\App\Models\SiteSetting::first();
        return view('user.home.index',compact('categories','lang','products','settings'));
    }

    function landingPage(){
        $categories=category::all();
        $lang=LaravelLocalization::setLocale();
        $products=product::query()->latest('created_at')->limit(8)->get();
        $settings=\App\Models\SiteSetting::first();
        return view('user.home.landingPage',compact('categories','lang','products','settings'));
    }
}
