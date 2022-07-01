<?php

namespace App\Models\Api\v1;

use App\Models\Admin\Horario;
use App\Models\Admin\Service;
use App\Models\Admin\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // protected $fillable = ['date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'];
    protected $fillable = ['date', 'hour_start', 'hour_end', 'horario_id', 'service_id', 'vehicle_id', 'employee_id', 'client_id', 'state_id'];

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function service(){ 
        return $this->belongsTo(Service::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function employee(){
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function state(){
        return $this->belongsTo(State::class);
    } 

    public function task(){
        return $this->belongsTo(Task::class);
    }

}
