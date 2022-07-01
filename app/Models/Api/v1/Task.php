<?php

namespace App\Models\Api\v1;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory; 

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = ['price', 'stocktaking', 'started', 'finished', 'appointment_id', 'yardManager_id'];

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function yardManager(){
        return $this->belongsTo(User::class, 'yardManager_id');
    }

    public function rating(){
        return $this->hasOne(Rating::class, 'task_id');
    }
}
