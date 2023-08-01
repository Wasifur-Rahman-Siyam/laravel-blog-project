<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $popular_posts = Post::withCount('comments')
        ->withCount('like_to_users')
        ->orderBy('comments_count','desc')
        ->orderBy('like_to_users_count','desc')
        ->take(5)->get();
        $pending_posts = $posts->where('is_approved', 0)->count();
        $approved_posts = $posts->where('is_approved', 1)->count();
        $total_user = User::count();
        $new_user_today = User::whereDate('created_at', Carbon::today())->count();
        $active_user = User::withCount('posts')
        ->orderBy('posts_count','desc')
        ->take(5)->get();
        $category_count = Category::count();
        $tag_count = Tag::count();
        return view('backend.admin.dashboard.index', compact('posts','popular_posts','pending_posts', 'approved_posts','total_user','new_user_today','active_user','category_count','tag_count'));
    }
}
