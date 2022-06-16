<?php

namespace App\Models\Admin;

use App\Models\Api\v1\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // relación uno a muchos 
    public function users(){
        return $this->hasMany(User::class, 'state_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
