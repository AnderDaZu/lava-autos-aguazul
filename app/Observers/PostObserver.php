<?php

namespace App\Observers;

use App\Models\Admin\Post;

class PostObserver
{
    public function creating(Post $post)
    {
        if (! \App::runningInConsole()) {

            $post->admin_id = auth()->user()->id;
            
        }
    }
}
