<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\String_;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::all();
        $data = [];

        foreach ($posts as $post) {
            $data[] = [
                'id' => $post->id,
                'name' => $post->name,
                'service' => $post->service->name,
                'url_image' => Storage::url($post->url_image),
                'extract' => $post->extract,
            ];
        }
      
        return response()->json( [
            "success" => true,
            "response" => $data
        ], 200);
    }
 
    public function show(Post $post) 
    {
        $data = [
            'id' => $post->id,
            'name' => $post->name,
            'service' => $post->service->name,
            'url_image' => Storage::url($post->url_image),
            'extract' => $post->extract,
            'body' => $post->body
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
