<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FindChallengesController;
use App\Http\Controllers\CreateChallengeController;
use App\Http\Controllers\RunningTotalsController;
use App\Http\Controllers\TrackActivityController;
use App\Http\Controllers\NotificationController;

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


Route::resource('user', UserController::class);
Route::resource('createchallenge', CreateChallengeController::class);
Route::resource('findchallenges', FindChallengesController::class);
Route::resource('trackactivity', TrackActivityController::class);
Route::resource('runningtotals', RunningTotalsController::class);





Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('profile');

Route::get('/', function () {
    return view('welcome');
});



Route::post('/profile', [App\Http\Controllers\ChallengeController::class, 'store'])->name('challenge');

Route::get('findchallenges', [App\Http\Controllers\CreateChallengeController::class, 'show'])->name('challenge.show'); 

Route::get('profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

//Route::delete('findchallenges', [FindChallengesController::class, 'destroy']);
//Route::get('findchallenges/','FindChallengesController@index');


Route::delete("/findchallenges", [FindChallengesController::class, 'erase'])->name('findchallenges.erase');
Route::delete("/createchallenge", [CreateChallengeController::class, 'destroy'])->name('createchallenge.destroy');


Route::post("/profile", [UserController::class, 'edit'])->name('usercontroller.edit');


Route::post("/findchallenges", [FindChallengesController::class, 'subscribe'])->name('findchallenges.subscribe');
Route::post("/unsubscribe", [FindChallengesController::class, 'unsubscribe'])->name('findchallenges.unsubscribe');

Route::post("/destroy", [TrackActivityController::class, 'destroy'])->name('trackactivity.destroy');

Route::get('lang/{lang}', ['as' => 'locale.switch', 'uses' => 'App\Http\Controllers\LocalizationController@switchLang']);

Route::get('/notify/{challenge}', [NotificationController::class, 'sendNotification']);