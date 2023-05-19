<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Comments;
use PhpParser\Node\Expr\New_;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment = new Comment();
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        $post = post::Find($post_id);
        $toUsers = User::find($post->user->id);
        $fromUsers = Auth::user();
        Notification::send($toUsers,new Comments($fromUsers, $post));
        return redirect()->back();
    }
}
