<?php

namespace App\Http\Controllers\user\cart;

use App\Http\Controllers\Controller;
use App\Models\cart;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CartController extends Controller
{
    function index(){
        $carts=[];
        if(\Auth::check()){
            $carts=cart::where('user_id',\Auth::user()->id)->get();
        }

        $lang=LaravelLocalization::setLocale();
        return view('user.cart.index',compact('carts','lang'));
    }
}
