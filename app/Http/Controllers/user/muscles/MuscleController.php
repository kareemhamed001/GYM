<?php

namespace App\Http\Controllers\user\muscles;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\muscle;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class MuscleController extends Controller
{

    function index()
    {
        $category=category::find(config('mainCategories.MusclesVideos.id'));
        $lang = LaravelLocalization::setLocale();
        $muscles = muscle::all();
        return view('user.trainingVideos.index', compact('category', 'lang', 'muscles'));

    }

}
