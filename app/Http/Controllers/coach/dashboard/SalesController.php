<?php

namespace App\Http\Controllers\coach\dashboard;
use App\Http\Controllers\Controller;


class SalesController extends Controller {

    function index(){
        return view('coach.Dashboard.sales');
    }
}
