<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    function index() 
    {
        $user = Auth::user();
        $posts = $user->posts;
        $popular_posts = $user->posts()
        ->withCount('comments')
        ->withCount('like_to_users')
        ->orderBy('comments_count','desc')
        ->orderBy('like_to_users_count','desc')
        ->take(5)->get();
        $pending_posts = $posts->where('is_approved', 0)->count();
        $approved_posts = $posts->where('is_approved', 1)->count();
        return view('backend.user.dashboard.index',compact('posts','popular_posts','pending_posts', 'approved_posts'));
    }
}
