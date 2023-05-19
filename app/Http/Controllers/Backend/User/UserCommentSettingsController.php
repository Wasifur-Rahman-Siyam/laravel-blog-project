<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserCommentSettingsController extends Controller
{
    public function index($post_id)
    {
        $post = post::Find($post_id);
        if($post->user_id != Auth::id()){
            return redirect()->back()->with('msg', 'You are not authorized to access this post Post');
        }
        $comments = Comment::where('post_id', $post_id)->get();
        return view('backend.user.post.comments',compact('comments','post_id'));
    }

    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id)->delete();
        return redirect()->back();
    }
}
