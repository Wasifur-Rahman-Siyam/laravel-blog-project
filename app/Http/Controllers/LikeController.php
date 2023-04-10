<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(){
        $posts = Auth::user()->likedPosts()->get();
        return view('frontend.liked-posts.index', compact('posts'));
    }
    public function like($post_id){
        $user = Auth::user();
        $isLiked = $user->likedPosts()->where('post_id',$post_id)->count();
        
        if($isLiked == 0){
            $user->likedPosts()->attach($post_id);
            $post = post::Find($post_id);
            $toUsers = $post->user;
            $fromUsers = Auth::user();
            Notification::send($toUsers,new Like($fromUsers, $post));
            return redirect()->back();
        }
        else{
            $user->likedPosts()->detach($post_id);
            return redirect()->back();
        }
    }
}
