<?php

namespace App\Http\Controllers\coach\settings;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;

class SettingsController extends Controller
{

    function index(){
        $settings=SiteSetting::latest()->first();
        return view('coach.settings.index',compact('settings'));
    }
}
