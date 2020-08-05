<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $profile = ProfileController::get($user->profile_id);

        return view(strtolower($profile->name));
    }
    else
    {
        return view('login', ["error"=> ""]);
    }
});

Route::post('/login', "UserController@login");
Route::post('/logout', "UserController@logout");