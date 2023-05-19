<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;
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


    public function index() 
    {
        $categories = Category::all();
        $recentPosts = post::latest()->take(6)->where('status', true)->where('is_approved', true)->get();
        $posts = Post::all()->where('status', true)->where('is_approved', true);
        if($posts->count() > 0) {
            $randomPosts = $posts->random(3);
        } else {
            // handle case where there are no posts available
            $randomPosts = collect([]);
        }
        $topCategories = Category::withCount('posts')
        ->orderByDesc('posts_count')
        ->take(10)
        ->get();
        return view('frontend.home.index',compact('categories','recentPosts', 'randomPosts','topCategories'));
    }

    public function categories() 
    {
        $categories = Category::all();
        return view('frontend.categories.index',compact('categories'));
    }

    public function postByCategory($slug) 
    {
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts;
        $bannerImage= $category->image;
        return view('frontend.Posts.index',compact('posts','bannerImage'));
    }

    public function postByTag($slug) 
    {
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts;
        $bannerImage= null;
        return view('frontend.Posts.index',compact('posts','bannerImage'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('frontend.post.index', compact('post'));
    }
}
