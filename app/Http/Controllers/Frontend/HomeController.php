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
        $recentPosts = post::latest()->take(6)->approved()->active()->get();
        $posts = Post::approved()->active()->get();
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
        $posts = $category->posts()->approved()->active()->get();
        $bannerImage= $category->image;
        return view('frontend.Posts.index',compact('posts','bannerImage'));
    }

    public function postByTag($slug) 
    {
        $searchTerm = $slug;
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->approved()->active()->get();
        return view('frontend.search.index',compact('posts','searchTerm'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->approved()->active()->first();
        if (is_null($post)) {
            abort(404);
        }
        return view('frontend.post.index', compact('post'));
    }
}
