<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
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

Route::get('/site-map', function(Request $request) {
    if (Auth::check()) {
        return view('site_map', ['user' => Auth::user()]);
    }
    else {
        return view('login');
    }
});

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
                $recentActivity = ReportController::getRecentActivityByUser($user->id);

                if($request->name) {
                    $reports = ReportController::getByName($request->name, $user->id);
                }
                else {
                    $reports = $user->reports;
                }
                
                return view('student', ["user" => $user, 
                                        "reports" => $reports, 
                                        "recentActivity" => $recentActivity]);
            
                case "Tutor":
                    $recentActivity = ReportController::getRecentActivityByTutor($user->id);                 

                    return view('tutor', ["user" => $user, 
                                          "students" => $user->students, 
                                          "recentActivity" => $recentActivity]);

                case "Responsable":
                    $users = UserController::getNewUsers();

                    return view('responsable', ["responsable" => $user, 
                                                "users" => $users]);
        }
    }
    else
    {
        return view('login', ['error'=> '', 'message' => '']);
    }
});

Route::get('/findStudent', function (Request $request) {
    if (Auth::check()) {
        $user = Auth::user();

        if($user->profile->name === "Tutor") {
            $students = UserController::getStudentByName($request->name, $user->id);
            $recentActivity = ReportController::getRecentActivityByTutor($user->id);
    
            return view('tutor', ["user" => $user, 
                                  "students" => $students, 
                                  "recentActivity" => $recentActivity]);
        }
        else {
            Auth::logout();
            return redirect('/');
        }
    }
    else {
        return redirect('/');
    }
    
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
        return view('login', ['error'=> '', 'message' => '']);
    }
});

Route::get('/tutor', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if($user->profile->name === "Student") {
            return view('tutor_student', ['tutor'=> $user->tutor, "recentActivity"=> ReportController::getRecentActivityByUser($user->id)]);   
        }
        else {
            Auth::logout();
            return redirect('/');
        }
    }
    else
    {
        return view('login', ['error'=> '', 'message' => '']);
    }
});

Route::get('/tracking/{id}', function ($id) {
    if (Auth::check()) {
        $user = Auth::user();

        if($user->profile->name === "Tutor") {
            $student = UserController::get($id);

            return view('tracking', ['student'=> $student, 
                                     'message' => '']);   
        }
        else {
            Auth::logout();
            return redirect('/');
        }
    }
    else
    {
        return redirect('/');
    }
});

Route::get('/tracking/{id}/add', function ($id) {
    if (Auth::check()) {
        $user = Auth::user();

        if($user->profile->name === "Tutor") {
            $student = UserController::get($id);
    
            return view('tracking_add', ['student'=> $student,
                                         'error' => '']);   
        }
        else {
            Auth::logout();
            return redirect('/');
        }
    }
    else
    {
        return redirect('/');
    }
});

Route::get('/tracking/{user_id}/edit/{report_id}', function ($user_id, $report_id) {
    if (Auth::check()) {
        $user = Auth::user();

        if($user->profile->name === "Tutor") {
            $student = UserController::get($user_id);
            $report = ReportController::get($report_id);
    
            return view('tracking_edit', ['student'=> $student, 
                                          'report'=>$report,
                                          'message' => '',
                                          'colorMessage' => '']);   
        }
        else {
            Auth::logout();
            return redirect('/');
        }
    }
    else
    {
        return redirect('/');
    }
});

Route::get('/responsable_register', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if($user->profile->name === "Responsable") {
            $enableUsers = UserController::getEnableUsers();
            $disableUsers = UserController::getDisabledUsers();

            return view('responsable_register', ["enableUsers" => $enableUsers, "disableUsers" => $disableUsers]);
        }
        else {
            Auth::logout();
            return redirect('/');
        }
    }
    else
    {
        return redirect('/');
    }
});

Route::get('/user/setTutor/{user_id}', function ($user_id) {
    if (Auth::check()) {
        $user = Auth::user();

        if($user->profile->name === "Responsable") {
            $user = UserController::get($user_id);
            $tutors = UserController::getTutors();

            return view('set_tutor', ['user'=> $user, 'tutors'=>$tutors]);   
        }
        else {
            Auth::logout();
            return redirect('/');
        }
    }
    else
    {
        return redirect('/');
    }
});

Route::get('/user/readNotifications/{user_id}', function($user_id) {
    $user = UserController::get($user_id);

    foreach($user->notifications as $notification) {
        $notification->isReaded = 1;
        $notification->save();
    }
});

Route::post('/uploadFile', function(Request $request) {
    if (Auth::check()) {
        $user = Auth::user();

        if($user->profile->name === "Student") {
            $path = $request->file('reportFile')->store('public');
            
            $report = ReportController::saveFile($request->id, str_replace('public/', '', $path));

            NotificationController::store($user->name . ' subió el docuemnto del informe "' . $report->name . '"', '/tracking/' . $user->id, $user->tutor_id);
            
            return redirect('/');
        }
        else {
            Auth::logout();
            return redirect('/');
        }
    } 
});

Route::post('/login', "UserController@login");
Route::post('/logout', "UserController@logout");
Route::post('/profile', "UserController@update");
Route::post('/register', "UserController@register");
Route::post('/resetPassword', "UserController@resetPassword");
Route::post('/user/rejected', "UserController@rejected");
Route::post('/user/accept', "UserController@accept");
Route::post('/user/setTutor', "UserController@setTutor");
Route::post('/user/finishPPS', "UserController@finishPPS");
Route::post('/report/store', "ReportController@store");
Route::post('/report/remove', "ReportController@remove");
Route::post('/report/edit', "ReportController@edit");