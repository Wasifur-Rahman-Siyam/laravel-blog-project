<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\post;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class HomeController extends Controller
{
    public function redirectUser(){
        if(auth()->user()->hasRole('admin')){
            return redirect()->route('admin.dashboard');
        }
        if(auth()->user()->hasRole('user')){
            return redirect()->route('user.dashboard');
        }
    }


    function index() {
        $categories = Category::all();
        $recentPosts = post::latest()->take(6)->where('status', true)->where('is_approved', true)->get();
        return view('frontend.home.index',compact('categories','recentPosts'));
    }

    function categories () {
        $categories = Category::all();
        return view('frontend.categories.index',compact('categories'));
    }
}
