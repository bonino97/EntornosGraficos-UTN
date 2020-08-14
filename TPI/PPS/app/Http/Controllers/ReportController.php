<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Create a report
     *
     * @param Request
     * @return bool
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
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
        else
        {
            return redirect('/');
        }
    }

    /**
     * Remove report
     *
     * @param Request
     */
    public function remove(Request $request)
    {
        if (Auth::check()) {
            $report = Report::where('id', $request->id)->first();
            $report->delete();

            return redirect('/tracking/' . $request->id);   
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Edit report
     *
     * @param Request
     */
    public function edit(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->profile->name === "Tutor") {
                try
                {
                    $report = Report::where('id', $request->report_id)->first();
                
                    $report->name = $request->title;
                    $report->slogan = $request->slogan;
                    $report->grade = $request->grade;
                    $report->comments = $request->comments;
                    $report->state = $request->state;
                    $report->save();

                    NotificationController::store('El tutor realizo correciones del informe "' . $report->name . '"', "/?name=" . $report->name, $report->user_id);

                    return redirect('/tracking/' . $request->user_id);   
                }
                catch(Exception $e)
                {
                    return redirect('/tracking/' . $request->user_id);   
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
     * Return recent activity by the user
     *
     * @param user_id
     * @return List<Report>
     */
    public static function getRecentActivityByUser($user_id)
    {
        if (Auth::check()) {
            return Report::where('user_id', $user_id)->orderBy('id', 'desc')->take(10)->get();   
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Return recent activity by the tutor
     *
     * @param tutor_id
     * @return List<Report>
     */
    public static function getRecentActivityByTutor($tutor_id)
    {
        if (Auth::check()) {
            return Report::select('reports.id', 'reports.name', 'reports.user_id')->join('users', 'reports.user_id', '=', 'users.id')->where('tutor_id', $tutor_id)->orderBy('reports.id', 'desc')->take(10)->get();
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Return a report by name
     *
     * @param name
     * @param user_id
     * @return Report
     */
    public static function getByName($name, $user_id)
    {
        if (Auth::check()) {
            return Report::where('user_id', $user_id)->where('name', 'like', '%' . $name .'%')->orderBy('id', 'desc')->take(10)->get();
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Return a report by name and tutor
     *
     * @param name
     * @param tutor_id
     * @return Report
     */
    public static function getByNameAndTutor($name, $tutor_id)
    {
        if (Auth::check()) {
            return Report::select('reports.name')->join('users', 'reports.user_id', '=', 'users.id')->where('reports.name', 'like', '%' . $name .'%')->where('tutor_id', $tutor_id)->orderBy('reports.id', 'desc')->take(10)->get();
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Return one report
     *
     * @param id
     * @return Report
     */
    public static function get($id)
    {
        if (Auth::check()) {
            return Report::where('id', $id)->first();
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Save file
     *
     * @param Request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function saveFile($id, $file)
    {
        if (Auth::check()) {
            try
            {
                $report = Report::where('id', $id)->first();

                $report->file = $file;
                $report->state = "A revisar";
                $report->save();
        
                return $report;
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
}