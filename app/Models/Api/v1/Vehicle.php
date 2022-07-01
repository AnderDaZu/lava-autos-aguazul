<?php

namespace App\Models\Api\v1;

use App\Models\Admin\Color;
use App\Models\Admin\Modelcar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory; 

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = ['plate', 'color_id', 'modelcar_id', 'client_id'];

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function modelcar(){
        return $this->belongsTo(Modelcar::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }
}
