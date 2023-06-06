<?php

namespace App\Http\Controllers\user\gym;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\gym;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GymController extends Controller
{

    function index(){
        $category = category::find(config('mainCategories.GymDiscount.id'));
        $lang = LaravelLocalization::setLocale();
        $gyms=gym::paginate();
        return view('user.gymDiscount.index', compact('category','lang','gyms'));
    }
    function show($id){
        $gym=gym::find($id);
        $lang=LaravelLocalization::setLocale();
        return view('user.gymDiscount.show',compact('gym','lang'));
    }
}
