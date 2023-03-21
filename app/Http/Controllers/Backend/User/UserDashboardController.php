<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    function index() {
        $notificationCount = auth()->user()->unreadNotifications->count();
        return view('backend.user.dashboard.index', compact('notificationCount'));
    }
}
