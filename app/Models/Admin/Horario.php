<?php

namespace App\Models\Admin;

use App\Models\Api\v1\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_hour',
        'end_hour'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'horario_id');
    } 

    public function spaces()
    {
        return $this->hasMany(Space::class, 'horario_id');
    }

    // Relación uno a muchos
    // public function agendas(){
    //     return $this->hasMany(Agenda::class);
    // }

}
