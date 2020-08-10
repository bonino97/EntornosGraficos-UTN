<?php

namespace App\Http\Controllers;

use App\Report;

class ReportController extends Controller
{
    public static function getRecentActivityByUser($user_id)
    {
        return Report::where('user_id', $user_id)->orderBy('id', 'desc')->take(10)->get();
    }

    public static function getByName($name, $user_id)
    {
        return Report::where('user_id', $user_id)->where('name', 'like', '%' . $name .'%')->orderBy('id', 'desc')->take(10)->get();
    }
}