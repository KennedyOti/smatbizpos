<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function supplier()
    {
        return view('portal.setting.supplier', []);
    }

    public function slide()
    {
        return view('portal.setting.slide', []);
    }
}
