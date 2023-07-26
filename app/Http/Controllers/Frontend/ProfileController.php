<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();
        $posts = $user->posts()->approved()->active()->get();
        return view('frontend.profile.index', compact('user', 'posts'));
    }
}
