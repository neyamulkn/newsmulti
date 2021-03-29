<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
class NotificationController extends Controller
{

    public function notifications()
    {
        $user_id = Auth::user()->id;
        $notifications = Notification::where('toUser', $user_id)->paginate(20);
        return view('frontend.notifications')->with(compact('notifications'));
    }

   
    public function readNotify($id)
    {
        $user_id = Auth::user()->id;
        Notification::where('toUser', $user_id)->where('id', $id)->update(['read' => 1]);
    }
}
