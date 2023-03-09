<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Expr\New_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('backend.post.index',compact('posts'));
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
        return view('backend.post.create',compact('categories','tags'));
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
        $post->is_approved = true;
        $post->save();
        $image= $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $fileName = $post->slug.'-'.$post->id.'.'.$extension;
            if (!file_exists('images/posts/')) {
                mkdir('images/posts/', 666, true);
            }
            $path = 'images/posts/' . $fileName;
            Image::make($image)->resize(1600,1066)->save($path);
            $post->image = $fileName;
            $post->save();
        }

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        return redirect()->back()->with('msg', 'Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('backend.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.post.edit',compact('post', 'categories','tags'));
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
        $post->is_approved = true;
        $post->save();
        $image= $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $fileName = $post->slug.'-'.$post->id.'.'.$extension;

            $deleteImage = 'images/posts/'.$post->image;
            if(File::exists($deleteImage)){
               File::delete($deleteImage);
            }
            if (!file_exists('images/posts')) {
                mkdir('images/posts/', 666, true);
            }
            $path = 'images/posts/' . $fileName;
            Image::make($image)->resize(1600,966)->save($path);
            $post->image = $fileName;
            $post->save();
        }

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        return redirect()->back()->with('msg', 'Post Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $deleteImage = 'images/posts/'.$post->image;
            if(File::exists($deleteImage)){
               File::delete($deleteImage);
            }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        return redirect()->back()->with('msg', 'Post Deleted Successfully');
    }
}
