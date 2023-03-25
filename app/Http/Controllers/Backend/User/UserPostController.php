<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Notifications\NewUserPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class UserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('backend.user.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.user.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|max:60|unique:posts',
            'image'             => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'categories'        => 'required',
            'tags'              => 'required',
            'body'              => 'required',
        ]);
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug  =   Str::slug($request->title);
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }
        else{
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();
        $image= $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $fileName = $post->slug.'-'.$post->id.'.'.$extension;
            if (!file_exists('images/posts/banner/')) {
                mkdir('images/posts/banner/', 666, true);
            }
            $path = 'images/posts/banner/' . $fileName;
            Image::make($image)->resize(1600,1066)->save($path);
            if (!file_exists('images/posts/card/')) {
                mkdir('images/posts/card/', 666, true);
            }
            $path = 'images/posts/card/' . $fileName;
            Image::make($image)->resize(353,253)->save($path);
            $post->image = $fileName;
            $post->save();
        }

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $users = User::role('admin')->get();
        Notification::send($users,new NewUserPost($post));
        return redirect()->route('user.post.index')->with('msg', 'Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id()){
            return redirect()->back()->with('msg', 'You are not authorized to access this post Post');
        }
        return view('backend.user.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){
            return redirect()->back()->with('msg', 'You are not authorized to access this post Post');
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.user.post.edit',compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id()){
            return redirect()->back()->with('msg', 'You are not authorized to access this post Post');
        }
        $request->validate([
            'title'             => 'required|max:60|unique:posts,title,'.$post->id,
            'image'             => 'image|mimes:jpg,png,jpeg,gif,svg',
            'categories'        => 'required',
            'tags'              => 'required',
            'body'              => 'required',
        ]);
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug  =   Str::slug($request->title);
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }
        else{
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();
        $image= $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $fileName = $post->slug.'-'.$post->id.'.'.$extension;

            $deleteImage = 'images/posts/banner/'.$post->image;
            if(File::exists($deleteImage)){
               File::delete($deleteImage);
            }
            if (!file_exists('images/posts/banner/')) {
                mkdir('images/posts/banner/', 666, true);
            }
            $path = 'images/posts/banner/' . $fileName;
            Image::make($image)->resize(1600,966)->save($path);

            $deleteImage = 'images/posts/card/'.$post->image;
            if(File::exists($deleteImage)){
               File::delete($deleteImage);
            }
            if (!file_exists('images/posts/card/')) {
                mkdir('images/posts/card/', 666, true);
            }
            $path = 'images/posts/card/' . $fileName;
            Image::make($image)->resize(353,253)->save($path);

            $post->image = $fileName;
            $post->save();
        }

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        return redirect()->route('user.post.index')->with('msg', 'Post Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id()){
            return redirect()->back()->with('msg', 'You are not authorized to access this post Post');
        }
        $deleteImage1 = 'images/posts/banner/'.$post->image;
        $deleteImage2 = 'images/posts/card/'.$post->image;
        if(File::exists($deleteImage1)){
            File::delete($deleteImage1);
        }
        if(File::exists($deleteImage2)){
            File::delete($deleteImage2);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        return redirect()->back()->with('msg', 'Post Deleted Successfully');
    }

}
