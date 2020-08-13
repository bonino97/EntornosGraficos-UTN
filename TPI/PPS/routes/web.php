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


Route::get('/register', function(Request $request) {
    return view('register', ['error' => '', 'message' => '']);
});

Route::get('/', function (Request $request) {
    if (Auth::check()) {
        $user = Auth::user();
        $profile = ProfileController::get($user->profile_id);

        switch($profile->name)
        {
            case "Student":
                if($request->name) {
                    $recentActivity = ReportController::getByName($request->name, $user->id);
                }
                else {
                    $recentActivity = ReportController::getRecentActivityByUser($user->id);
                }
                
                return view('student', ["reports" => $user->reports, "recentActivity" => $recentActivity]);
            
                case "Tutor":
                    if($request->name) {
                        $recentActivity = ReportController::getByNameAndTutor($request->name, $user->id);
                    }
                    else {
                        $recentActivity = ReportController::getRecentActivityByTutor($user->id);
                    }                    

                    return view('tutor', ["students" => $user->students, "recentActivity" => $recentActivity]);
        }
    }
    else
    {
        return view('login', ["error"=> ""]);
    }
});

Route::get('/findStudent', function (Request $request) {
    $students = UserController::getStudentByName($request->name);
    
    return view('tutor', ["students" => $students]);
});

Route::get('/profile', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $profile = ProfileController::get($user->profile_id);

        switch($profile->name)
        {
            case "Student":
                $recentActivity = ReportController::getRecentActivityByUser($user->id);

                break;

            case "Tutor":
                $recentActivity = ReportController::getRecentActivityByTutor($user->id);

                break;
        }

        return view('profile', ["user" => $user, 
                                "message" => "", 
                                "color" => "", 
                                "recentActivity" => $recentActivity, 
                                "profile" => $profile]);
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

Route::get('/tracking/{id}', function ($id) {
    if (Auth::check()) {
        $user = Auth::user();
        $student = UserController::get($id);

        return view('tracking', ['student'=> $student]);
    }
    else
    {
        return redirect('/');
    }
});

Route::get('/tracking/{id}/add', function ($id) {
    if (Auth::check()) {
        $user = Auth::user();
        $student = UserController::get($id);

        return view('tracking_add', ['student'=> $student]);
    }
    else
    {
        return redirect('/');
    }
});

Route::get('/tracking/{user_id}/edit/{report_id}', function ($user_id, $report_id) {
    if (Auth::check()) {
        $user = Auth::user();
        $student = UserController::get($user_id);
        $report = ReportController::get($report_id);

        return view('tracking_edit', ['student'=> $student, 'report'=>$report]);
    }
    else
    {
        return redirect('/');
    }
});

Route::post('/uploadFile', function(Request $request) {
    if (Auth::check()) {
        $user = Auth::user();
        $profile = ProfileController::get($user->profile_id);
        $path = $request->file('reportFile')->store('public');
        
        ReportController::saveFile($request->id, str_replace('public/', '', $path));
        
        return redirect('/');
    } 
});

Route::post('/login', "UserController@login");
Route::post('/logout', "UserController@logout");
Route::post('/profile', "UserController@update");
Route::post('/register', "UserController@register");
Route::post('/resetPassword', "UserController@resetPassword");
Route::post('/report/store', "ReportController@store");
Route::post('/report/remove', "ReportController@remove");
Route::post('/report/edit', "ReportController@edit");