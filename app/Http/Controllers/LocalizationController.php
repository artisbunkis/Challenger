<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index(Request $request, $locale){
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
