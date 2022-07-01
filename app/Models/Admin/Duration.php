<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = ['duration'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function spaces()
    {
        return $this->hasMany(Space::class);
    }

}
