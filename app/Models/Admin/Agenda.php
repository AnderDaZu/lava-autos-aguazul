<?php

namespace App\Models\Admin;

use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\employee\Appointment as EmployeeAppointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory; 

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'horario_id',
        'employee_id',
        'admin_id'
    ];

    public function horario(){
        return $this->belongsTo(Horario::class);
    }

    public function employee(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(User::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

}
