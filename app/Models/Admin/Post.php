<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'extract', 'body', 'url_image', 'admin_id', 'service_id'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
