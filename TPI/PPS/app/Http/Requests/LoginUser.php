<?php

namespace App\Http\Requests;

class LoginUser extends ApiRequest
{
  /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ];
    }
}