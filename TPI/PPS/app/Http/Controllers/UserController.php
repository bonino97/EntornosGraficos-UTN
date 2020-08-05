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
        $response = new ApiResponse;

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect('/');
        }
        else
        {
            return view('login', ["error"=> "Los datos no son correctos"]);
        }

        return $response->getResponse();
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
}