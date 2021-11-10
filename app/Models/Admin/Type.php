<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    // public function Lines(){
    //     return $this->hasMany(Line::class, 'type_id');
    // }

    public function modelcars(){
        return $this->hasMany(Modelcar::class, 'type_id');
    }

    public function services(){
        return $this->hasMany(Service::class, 'type_id');
    }
}
