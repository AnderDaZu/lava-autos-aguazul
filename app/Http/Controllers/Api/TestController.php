<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $data = [];
        foreach ($posts as $post) {
            // $data[] = env('APP_URL').Storage::url($post->url_image); 
            $data[] = Storage::url($post->url_image); 
        }
        return response()->json(["response" => $data], 200);
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        //
    }

}
