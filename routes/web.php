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



Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('profile');

Route::get('/', function () {
    return view('welcome');
});



Route::post('/profile', [App\Http\Controllers\ChallengeController::class, 'store'])->name('challenge');

Route::get('/findchallenges', [App\Http\Controllers\CreateChallengeController::class, 'show'])->name('challenge.show'); 




//LOCALE ROUTES
Route::get('/{lang}', function($lang){
    App:: setLocale($lang);
    return view('welcome');
}); 

Route::get('/profile/{lang}', function($lang){
    App:: setLocale($lang);
    return view('/profile');
});

// Route::get('/findchallenges/{lang}', function($lang){
//     App:: setLocale($lang);
//     return view('findchallenges', compact('challenges', 'sportsTypes', 'measurements', 'user_ids'));
// });

// Route::get('/createchallenge/{lang}', function($lang){
//     App:: setLocale($lang);
//     return view('createchallenge');
// });

// Route::get('/trackactivity/{lang}', function($lang){
//     App:: setLocale($lang);
//     return view('/trackactivity');
// });


// Route::get('/runningtotals/{lang}', function($lang){
//     App:: setLocale($lang);
//     return view('/runningtotals');
// });