<?php

namespace App\Http\Controllers\user\categories;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoriesController extends Controller
{
    function index(){
        $categories=category::all();
        $lang=LaravelLocalization::setLocale();
        return view('user.categories.index',compact('categories','lang'));
    }
}
