<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LocalizationController extends Controller
{
    public function switchLang($locale){
        
        if (array_key_exists($locale, Config::get('languages'))) {
            session()->put('locale', $locale);
        }
        
        
        return redirect()->back();
    }
 
}
