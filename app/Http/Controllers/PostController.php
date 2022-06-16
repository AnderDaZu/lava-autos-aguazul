<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller 
{

    public function index()
    {
        $posts = Post::all();
        return view('welcome', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('post', compact('post'));
    }

}
