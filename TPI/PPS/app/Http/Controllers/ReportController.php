<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $report = new Report;

            $report->fill([
                'name' => $request->input('title'),
                'slogan' => $request->input('slogan'),
                'user_id' => $request->input('user_id'),
                'state' => 'Asignada'
            ]);
    
            $report->save();

            return redirect('/tracking/' . $request->user_id);
        }
        catch(Exception $e)
        {
            //TODO Falta validación
            return false;
        }        
    }

    public function remove(Request $request)
    {
        $report = Report::where('id', $request->id)->first();
        $report->delete();

        return redirect('/tracking/' . $request->id);   
    }

    public function edit(Request $request)
    {
        try
        {
            $report = Report::where('id', $request->report_id)->first();
        
            $report->name = $request->title;
            $report->slogan = $request->slogan;
            $report->grade = $request->grade;
            $report->comments = $request->comments;
            $report->state = $request->state;

            $report->save();

            return redirect('/tracking/' . $request->user_id);   
        }
        catch(Exception $e)
        {
            return redirect('/tracking/' . $request->user_id);   
        }
    }

    public static function getRecentActivityByUser($user_id)
    {
        return Report::where('user_id', $user_id)->orderBy('id', 'desc')->take(10)->get();
    }

    public static function getRecentActivityByTutor($tutor_id)
    {
        return Report::select('reports.name')->join('users', 'reports.user_id', '=', 'users.id')->where('tutor_id', $tutor_id)->orderBy('reports.id', 'desc')->take(10)->get();
    }

    public static function getByName($name, $user_id)
    {
        return Report::where('user_id', $user_id)->where('name', 'like', '%' . $name .'%')->orderBy('id', 'desc')->take(10)->get();
    }

    public static function getByNameAndTutor($name, $tutor_id)
    {
        return Report::select('reports.name')->join('users', 'reports.user_id', '=', 'users.id')->where('reports.name', 'like', '%' . $name .'%')->where('tutor_id', $tutor_id)->orderBy('reports.id', 'desc')->take(10)->get();
    }

    public static function get($id)
    {
        return Report::where('id', $id)->first();
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
            $report->state = "A revisar";
            $report->save();
    
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }        
    }
}