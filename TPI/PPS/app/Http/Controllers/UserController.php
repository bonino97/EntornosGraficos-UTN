<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Utils\Enums\Status;
use App\User;
use Mail;

class UserController extends Controller
{
    /**
     * Login user
     *
     * @param LoginUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUser $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if($user->state !== 1) {
                Auth::logout();
            }

            return redirect('/');
        }
        else
        {
            return view('login', ['error'=> 'Los datos no son correctos', 'message' => '']);
        }
    }

    /**
     * Logout user.
     *
     * @param Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    } 

    /**
     * Register a user
     *
     * @param Request
     */
    public function register(Request $request)
    {
        $profile = ProfileController::getByName($request->profile);
        
        if($profile !== null) {
            if(!$request->name) {
                return view('register', ['error' => 'El titulo no puede ser vacío']);
            }

            if(!$request->file) {
                return view('register', ['error' => 'El legajo no puede ser vacío']);
            }

            if(!$request->email) {
                return view('register', ['error' => 'El email no puede ser vacío']);
            }

            if(!$request->password) {
                return view('register', ['error' => 'La clave no puede ser vacía']);
            }

            if(!$request->repeatPassword) {
                return view('register', ['error' => 'La conrimación de clave no puede ser vacía']);
            }

            if($request->password !== $request->repeatPassword) {
                return view('register', ['error' => 'Las claves no coinciden']);
            }

            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->file = $request->file;
            $user->password = Hash::make($request->password);
            $user->profile_id = $profile->id;

            $user->save();

            //Send notification to admin
            $responsableProfile = ProfileController::getByName("Responsable");
            $responsables = User::where('profile_id', $responsableProfile->id)->where('state', 1)->get();

            foreach($responsables as $responsable)
            {
                NotificationController::store("Nuevo registro: " . $user->name, "/", $responsable->id);
            }

            return redirect('/');
        }
        else
        {
            return view('register', ['error' => 'El perfil no existe']);
        }
    }

    /**
     * Reset password
     *
     * @param Request
     */
    public function resetPassword(Request $request)
    {
        try
        {
            $user = User::where('email', $request->email)->first();
        
            if($user !== null)
            {
                $newPassword = Str::random(8);

                //Send mail
                $subject = 'Reseteo de clave PPS Web';
                $for = $user->email;

                $user->password = Hash::make($newPassword);
    
                $user->save();

                Mail::send('/login', ['error' => '', 'message' => 'Se envio por email la nueva clave'], function($msj) use($subject,$for){
                    $msj->from("ppswebutn@gmail.com","PPS");
                    $msj->subject($subject);
                    $msj->to($for);
                });
            }
            else
            {
                return view('login', ['error'=> 'El email ingresado no pertenece a ningun usuario', 'message' => '']);
            }
        }
        catch(Exception $ex)
        {
            return view('login', ['error'=> 'Ócurrio un error reseteando la clave, reintente.', 'message' => '']);
        }
    }

    /**
     * Reject user created
     *
     * @param Request
     */
    public function rejected(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Responsable") {
                $user = User::where('id', $request->id)->first();
                $user->state = -1;
                $user->save();

                return redirect('/');
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
    }

    /**
     * Accept user created
     *
     * @param LoginUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Responsable") {
                $user = User::where('id', $request->id)->first();

                if($user->profile->name === "Tutor")
                {
                    $user->state = 1;
                    $user->save();

                    return redirect('/');
                }
                else
                {
                    return redirect('/user/setTutor/' . $user->id);
                }
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
    }

    /**
     * Set tutor to student
     *
     * @param Request
     */
    public function setTutor(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Responsable") {
                $user = User::where('id', $request->id)->first();   
                $tutor = User::where('id', $request->tutor)->first();   
                
                $user->tutor_id = $tutor->id;
                $user->state = 1;

                $user->save();

                //Notification to tutor
                NotificationController::store("Se le ha asignado un nuevo alumno: " . $user->name, "/findStudent?name=" . $user->name, $tutor->id);

                return redirect('/');
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
    }

    /**
     * Finish PPS for one user
     *
     * @param Request 
     */
    public function finishPPS(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Responsable") {
                $user = User::where('id', $request->id)->first();      
                $user->tutor_id = null;
                $user->state = 2;
                $user->save();

                return redirect('/responsable_register');
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
    }

    /**
     * Update user.
     *
     * @param Request
     */
    public function update(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch($user->profile->name)
            {
                case "Student":
                    $recentActivity = ReportController::getRecentActivityByUser($user->id);

                    break;

                case "Tutor":
                    $recentActivity = ReportController::getRecentActivityByTutor($user->id);

                    break;
            }

            try
            {
                if(!$request->name) {
                    return view('profile', ["user"=> $user, 
                                            "message" => "El nombre no puede ser vacío", 
                                            "color"=> "#DC3545", 
                                            "recentActivity"=> $recentActivity]);   
                }

                if(!$request->email) {
                    return view('profile', ["user"=> $user, 
                                            "message" => "El email no puede ser vacío", 
                                            "color"=> "#DC3545", 
                                            "recentActivity"=> $recentActivity]);   
                }

                $user->name = $request->name;
                $user->email = $request->email;
        
                $user->save();
        
                return view('profile', ["user"=> $user, 
                                        "message" => "El cambio se guardo con éxito", 
                                        "color"=> "#28A745", 
                                        "recentActivity"=> $recentActivity]);
            }
            catch(Exception $e)
            {
                return view('profile', ["user"=> $user, 
                                        "message" => "Ócurrio un error guardando los cambios", 
                                        "color"=> "#DC3545", 
                                        "recentActivity"=> $recentActivity]);
            }     
        }
        else
        {
            return redirect('/');
        }   
    }

    /**
     * Get one.
     *
     * @param Request
     * @return User
     */
    public static function get($id)
    {
        if (Auth::check()) {
            $user = Auth::user();

            try
            {
                $user = User::where('id', $id)->first();

                return $user;
            }
            catch(Exception $e)
            {
                return null;
            }
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Get student by name
     *
     * @param name
     * @return User
     */
    public static function getStudentByName($name, $tutor_id)
    {
        if (Auth::check()) {
            $user = Auth::user();

            try
            {
                $users = User::where('name', 'like', '%' . $name .'%')->where('tutor_id', $tutor_id)->get();

                return $users;
            }
            catch(Exception $e)
            {
                return null;
            }           
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Get new user
     *
     * @return User
     */
    public static function getNewUsers()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Responsable") {
                try
                {
                    $users = User::where('state', 0)->get();

                    return $users;
                }
                catch(Exception $e)
                {
                    return null;
                }         
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
    }

    /**
     * Get tutors
     *
     * @return User
     */
    public static function getTutors()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Responsable") {
                try
                {
                    $profile = ProfileController::getByName("Tutor");

                    $tutors = User::where('profile_id', $profile->id)->get();

                    return $tutors;
                }
                catch(Exception $e)
                {
                    return null;
                }
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
    }

    /**
     * Get enabled users
     *
     * @return List<User>
     */
    public static function getEnableUsers()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Responsable") {
                try
                {
                    $profile = ProfileController::getByName("Student");
                    $users = User::where('state', 1)->where('profile_id', $profile->id)->get();

                    return $users;
                }
                catch(Exception $e)
                {
                    return null;
                }
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
    }

    /**
     * Get enabled users
     *
     * @return List<User>
     */
    public static function getDisabledUsers()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Responsable") {
                try
                {
                    $profile = ProfileController::getByName("Student");
                    $users = User::where('state', 2)->where('profile_id', $profile->id)->get();

                    return $users;
                }
                catch(Exception $e)
                {
                    return null;
                }
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
    }
}