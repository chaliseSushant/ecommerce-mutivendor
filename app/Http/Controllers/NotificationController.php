<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notification = Auth::user()->unreadNotifications;
        return $notification;
    }
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        return response('Successfully marked all of your Notifications as Read.',200);
    }
    public function redirectAfterNotification($id)
    {
        $notification = Notification::where('id',$id)->first();
        $target_url = json_decode($notification->data, true)['target_url'];
        if ($notification->read_at == null)
        {
            $notification->update(['read_at' => now()]);
        }
        return Redirect::to($target_url);

    }
}
