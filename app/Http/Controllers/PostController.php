<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{

    public function index()
    {
        $post = Post::where('display','1')->get();
        return view('post.index', compact('post'));
    }

    public function item($id)
    {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }

}
