<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($notificationId)
    {
        auth()->user()->notifications()->where('id', $notificationId)->markAsRead();

        return redirect()->back();
    }
}
