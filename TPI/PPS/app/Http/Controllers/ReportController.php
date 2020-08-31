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
            $tutor = Auth::user();
            $student = UserController::get($request->user_id);

            if(!$request->user_id) {
                return redirect('/');
            }

            try
            {
                if(!$request->title) {
                    return view('tracking_add', ['student'=> $student,
                                                 'error' => 'El título no puede ser vacío.']);   
                }

                if(!$request->slogan) {
                    return view('tracking_add', ['student'=> $student,
                                                 'error' => 'La consigna no puede ser vacía.']);   
                }

                if($tutor->id !== $student->tutor_id) {
                    Auth::logout();
                    return redirect('/');   
                }

                $report = new Report;
                $report->name = $request->title;
                $report->slogan = $request->slogan;
                $report->user_id = $request->user_id;
                $report->state = 'Asignada';
                $report->save();

                return view('tracking', ['student'=> $student, 
                                         'message' => 'El informe se creo con éxito.']);   
            }
            catch(Exception $e)
            {
                return view('tracking_add', ['student'=> $student,
                                             'error' => 'Ócurrio un error creando el informe.']);   
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
            $tutor = Auth::user();
            $report = Report::where('id', $request->id)->first();
            $student = $report->student;

            if($student->tutor_id !== $tutor->id) {
                Auth::logout();
                return redirect('/');   
            }

            $report->delete();

            return view('tracking', ['student'=> $student, 
                                     'message' => 'El informe se elminio con éxito.']);   
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
            $tutor = Auth::user();

            if($tutor->profile->name === "Tutor") {
                try
                {
                    $report = Report::where('id', $request->report_id)->first();
                    $student = $report->student;

                    if(!$request->report_id) {
                        return redirect('/');
                    }

                    if($student->tutor_id !== $tutor->id) {
                        Auth::logout();
                        return redirect('/');   
                    }
    
                    if(!$request->title) {
                        return view('tracking_edit', ['student'=> $student, 
                                                      'report'=>$report,
                                                      'message' => 'El titulo no puede ser vacío.',
                                                      'colorMessage' => '#CE6161']);   
                    }

                    if(!$request->slogan) {
                        return view('tracking_edit', ['student'=> $student, 
                                                      'report'=>$report,
                                                      'message' => 'La consigna no puede ser vacía.',
                                                      'colorMessage' => '#CE6161']);   
                    }
                
                    $report->name = $request->title;
                    $report->slogan = $request->slogan;
                    $report->comments = $request->comments;
                    $report->state = $request->state;
                    $report->save();

                    NotificationController::store('El tutor realizo correciones del informe "' . $report->name . '"', "/?name=" . $report->name, $report->user_id);

                    return view('tracking_edit', ['student'=> $student, 
                                                  'report'=>$report,
                                                  'message' => 'Se realizaron los cambios con éxito.',
                                                  'colorMessage' => '#28A745']);   
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