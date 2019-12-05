<?php

namespace App\Http\Controllers;
use App\AdminNotification;
use Illuminate\Http\Request;

use Auth;

class AdminNotificationController extends Controller
{
    public function index (GlobalMethods $globalMethods) //function gets notification page
    {
        $notification = AdminNotification::where('admin_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        foreach($notification as $notifications)
        {
            if($notifications->read_at == null)
            {
                $read = [
                    'read_at' => \Carbon\Carbon::now()];
                $flag = $notifications->update($read);
            }
        }
        return view('v1.views.investor_dashboard.notifications.notification')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('notifications', $notification);
    }
    //end//

    public static function getUnreadNotifications () //function gets unread notifications
    {
        $notification = AdminNotification::where('admin_id', Auth::user()->id)->where('read_at', Null)->orderBy('id', 'desc')->get();
        return $notification;
    }
    //end//

    public static function getReadNotifications () //function gets read notifications 
    {
        $notification = AdminNotification::where('admin_id', Auth::user()->id)->where('read_at', '!=', Null)->orderBy('id', 'desc')->get();
        return $notification;
    }
    //end//

    public static function getAllNotifications () //function gets all notifications
    {
        $notification = AdminNotification::where('admin_id', Auth::user()->id)->get();
        return $notification;
    }
    //end//

    public static function markAsRead () //function marks notifications as read
    {
        $notification = AdminNotification::where('admin_id', Auth::user()->id)->where('read_at', Null);
        $read = [
            'read_at' => \Carbon\Carbon::now()];
        $flag = $notification->update($read);
        
        if($flag)//checking if notification was successfully flagged as read
        {
            return redirect()->back();
        }
        return redirect()->back();
        //end//
    }
}
