<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;
use App\Http\Controllers\FindChallengesController;
use App\Http\Controllers\CreateChallengeController;
use App\Http\Controllers\RunningTotalsController;
use App\Http\Controllers\TrackActivityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();

Route::resource('createchallenge', CreateChallengeController::class);
Route::resource('findchallenges', FindChallengesController::class);
Route::resource('trackactivity', TrackActivityController::class);
Route::resource('runningtotals', RunningTotalsController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});



Route::post('/home', [App\Http\Controllers\ChallengeController::class, 'store'])->name('challenge');