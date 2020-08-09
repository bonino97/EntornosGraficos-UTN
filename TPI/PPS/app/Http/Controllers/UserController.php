<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\Enums\Status;

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
    
            return view('profile', ["user"=> $user, "message" => "El cambio se guardo con éxito", "color"=> "#28A745"]);
        }
        catch(Exception $e)
        {
            return view('profile', ["user"=> $user, "message" => "Ócurrio un error guardando los cambios", "color"=> "#DC3545"]);
        }        
    }
}