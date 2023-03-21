<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {
        $notificationCount = auth()->user()->unreadNotifications->count();
        return view('backend.admin.dashboard.index', compact('notificationCount'));
    }
}
