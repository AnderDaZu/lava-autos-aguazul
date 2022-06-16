<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Admin\Post;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::select('posts.id', 'posts.name', 'types.name as type', 'services.name as service', 'users.name as name_user', 'users.last_name as last_name_user', 'posts.created_at as created')
        ->join('services', 'services.id', '=', 'posts.service_id')
        ->join('users', 'users.id', '=', 'posts.admin_id')
        ->join('types', 'types.id', '=', 'services.type_id')
        ->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $type_vehicles = Type::pluck('name', 'id');

        return view('admin.posts.create', compact('type_vehicles'));
    }

    public function store(PostRequest $request)
    {
        $url = Storage::put('public/posts', $request->file('file'));
        
        $post = Post::create([
            'name' => $request->name,
            'url_image' => $url,
            'extract' => $request->extract,
            'body' => $request->body,
            'service_id' => $request->service_id,
        ]);

        $name = $post->name;

        Alert::success("Post: $name", 'Ha sido creado correctamente');

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string|max:50',
            'extract' => 'required|string|min:20',
            'body' => 'required|string|min:50',
        ]);

        $post->update($request->only('name', 'extract', 'body'));

        $name = $post->name;

        toast("Post: $name, ha sido actualizado correctamente",'success');

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $name = $post->name;
        $post->delete();
        toast('El post "'.$name.'" se ha eleminado!', 'info');

        return redirect()->route('admin.posts.index');
    }
}
