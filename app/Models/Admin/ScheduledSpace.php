<?php

namespace App\Models\Admin;

use App\Models\Api\v1\Appointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledSpace extends Model
{
    use HasFactory;

    protected $fillable = ['num', 'date', 'range_id', 'appointment_id'];

    public function range(){
        return $this->belongsTo(Range::class);
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
}
