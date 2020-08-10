<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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


// Route::view('/register', "register");

Route::get('/', function (Request $request) {
    if (Auth::check()) {
        $user = Auth::user();
        $profile = ProfileController::get($user->profile_id);

        if($request->get('name'))
        {
            return view(strtolower($profile->name), ["reports"=> ReportController::getByName(Request::get('name'), $user->id), "recentActivity"=> ReportController::getRecentActivityByUser($user->id)]);
        }
        else
        {
            return view(strtolower($profile->name), ["reports"=> $user->reports, "recentActivity"=> ReportController::getRecentActivityByUser($user->id)]);
        }
    }
    else
    {
        return view('login', ["error"=> ""]);
    }
});

Route::get('/profile', function () {
    if (Auth::check()) {
        $user = Auth::user();

        return view('profile', ["user"=> $user, "message"=> "", "color"=> "", "recentActivity"=> ReportController::getRecentActivityByUser($user->id)]);
    }
    else
    {
        return view('login', ["error"=> ""]);
    }
});

Route::get('/tutor', function () {
    if (Auth::check()) {
        $user = Auth::user();

        return view('tutor_student', ['tutor'=> $user->tutor, "recentActivity"=> ReportController::getRecentActivityByUser($user->id)]);
    }
    else
    {
        return view('login', ["error"=> ""]);
    }
});

Route::post('/uploadFile', function(Request $request) {
    if (Auth::check()) {
        $user = Auth::user();
        $profile = ProfileController::get($user->profile_id);
        
        $path = $request->file('reportFile')->store('images');
        UserController::saveFile($path);
        return redirect('/');
    } 
});

Route::post('/login', "UserController@login");
Route::post('/logout', "UserController@logout");
Route::post('/profile', "UserController@update");
Route::post('/register', "UserController@register");
