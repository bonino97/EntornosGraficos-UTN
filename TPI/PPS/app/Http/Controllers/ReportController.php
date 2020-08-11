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

    /**
     * Save file
     *
     * @param Request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function saveFile($id, $file)
    {
        try
        {
            $report = Report::where('id', $id)->first();

            $report->file = $file;
            $report->save();
    
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }        
    }
}