<?php

namespace App\Models\Admin;

use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\UnscheduledTask;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = ['name', 'price', 'duration_id', 'type_id'];

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }

    public function duration()
    {
        return $this->belongsTo(Duration::class); 
    }

    public function type(){ 
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function unscheduledTask()
    {
        return $this->hasMany(UnscheduledTask::class, 'servicio_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'service_id');
    }
}
