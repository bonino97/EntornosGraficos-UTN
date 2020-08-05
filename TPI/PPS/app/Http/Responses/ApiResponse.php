<?php

namespace App\Http\Responses;

class ApiResponse
{
    public $status;
    public $message;

    public function getResponse()
    {
        return json_encode($this);
    }
}