<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'commentable_type' => 'required',
            'commentable_id' => 'required|integer',
            'username' => 'required|max:8',
            'Content' => 'required|min:2|max:500',
            'email' => 'email'
        ]);

        $comment = new Comment();
        $comment->commentable_type = $request->commentable_type;
        $comment->commentable_id = $request->commentable_id;
        $comment->username = $request->username;
        $comment->content = $request->Content;
        $comment->display = $request->display;
        $comment->site = $request->site;
        $comment->email = $request->email;
        $comment->save();

        Cookie::queue('userName', $comment->username, 3600);
        Cookie::queue('userEmail', $comment->email, 3600);
        Cookie::queue('userSite', $comment->site, 3600);

        return redirect()->back()->with('position', 'comment')->with('notify', ['type' => 'success', 'text' => '评论成功']);
    }

}
