<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function show(){
        $notifications = auth()->user()->unreadNotifications;
        return view('backend.notifications.index',compact('notifications'));
    }

    public function markasread($id){
        if($id){
            auth()->user()->unreadNotifications->where('id',$id)->markAsRead();
        }
        return back();
    }

}
