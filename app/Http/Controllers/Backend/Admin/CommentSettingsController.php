<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentSettingsController extends Controller
{
    public function index($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->get();
        return view('backend.admin.post.comments',compact('comments','post_id'));
    }

    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id)->delete();
        return redirect()->back();
    }
}
