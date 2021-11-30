<?php

namespace App\Models\Api\v1;

use App\Models\Admin\Agenda;
use App\Models\Admin\ScheduledSpace;
use App\Models\Admin\Service;
use App\Models\Admin\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // protected $fillable = ['date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'];
    protected $fillable = ['date', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'];

    public function agenda(){
        return $this->belongsTo(Agenda::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    // public function employee(){
    //     return $this->belongsTo(User::class, 'employee_id');
    // }

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function state(){
        return $this->belongsTo(State::class);
    } 

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function scheduled_spaces(){
        return $this->hasMany(ScheduledSpace::class);
    }
}
