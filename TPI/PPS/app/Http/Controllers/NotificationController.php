<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    /**
     * Add notification.
     *
     * @param title
     * @param url
     * @param user_id
     * @return bool
     */
    public static function store($title, $url, $user_id)
    {
        try
        {
            $notification = new Notification;
            $notification->title = $title;
            $notification->url = $url;
            $notification->user_id = $user_id;
            $notification->save();

            return true;
        }
        catch(Exception $e)
        {
            
            return false;
        }
    }
}
