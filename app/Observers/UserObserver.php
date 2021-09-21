<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\User;

class UserObserver
{
    
    public function creating(User $user)
    {
        if (! \App::runningInConsole()) {
            $user->user_id = auth()->user()->id;
            $user->remember_token = Str::random(10);
        }
    }

}
