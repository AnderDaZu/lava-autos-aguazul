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
        for ($i=0; $i < count($posts); $i++) { 
            $data[$i] = [
                'id' => $posts[$i]->id,
                'name' => $posts[$i]->name,
                'service' => $posts[$i]->service->name,
                'url_image' => Storage::url($posts[$i]->url_image),
                'extract' => $posts[$i]->extract,
            ];
        }
      
        return response()->json( ["result" => $data], 200);
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

        return response()->json(['data' => $data], 200);
    }
}
