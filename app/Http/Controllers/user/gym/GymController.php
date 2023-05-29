<?php

namespace App\Http\Controllers\user\gym;

use App\Http\Controllers\Controller;
use App\Models\gym;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GymController extends Controller
{

    function show($id){
        $gym=gym::find($id);
        $lang=LaravelLocalization::setLocale();
        return view('user.gymDiscount.show',compact('gym','lang'));
    }
}
