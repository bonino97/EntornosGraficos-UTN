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
            return redirect('/');
        }
        else
        {
            return view('login', ["error"=> "Los datos no son correctos"]);
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

    public function register(Request $request)
    {
        $profile = ProfileController::getByName($request->profile);

        if($profile !== null)
        {
            if($request->password !== $request->repeatPassword)
            {
                return view('register', ['error' => 'Las claves no coinciden', 'message' => '']);
            }

            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->profile_id = $profile->id;

            $user->save();

            return redirect('/');
        }
        else
        {
            return view('register', ['error' => 'El perfil no existe']);
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if($user !== null)
        {
            $newPassword = Str::random(8);
            
            $user->password = Hash::make($newPassword);

            $user->save();
            //TODO Falta mandar el mail
            return redirect('/');
        }
        else
        {
            return view('login', ["error"=> "El email ingresado no pertenece a ningun usuario"]);
        }
    }

    /**
     * Update user.
     *
     * @param Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try
        {
            $user = Auth::user();
        
            $user->name = $request->name;
            $user->email = $request->email;
    
            $user->save();
    
            return view('profile', ["user"=> $user, "message" => "El cambio se guardo con éxito", "color"=> "#28A745", "recentActivity"=> ReportController::getRecentActivityByUser($user->id)]);
        }
        catch(Exception $e)
        {
            return view('profile', ["user"=> $user, "message" => "Ócurrio un error guardando los cambios", "color"=> "#DC3545", "recentActivity"=> ReportController::getRecentActivityByUser($user->id)]);
        }        
    }

    /**
     * Get one.
     *
     * @param Request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function get($id)
    {
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

    public static function getStudentByName($name)
    {
        try
        {
            $users = User::where('name', 'like', '%' . $name .'%')->get();

            return $users;
        }
        catch(Exception $e)
        {
            return null;
        }           
    }
}