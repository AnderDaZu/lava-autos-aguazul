<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    // public function Lines(){
    //     return $this->hasMany(Line::class,'mark_id');
    // }

    public function modelcars(){
        return $this->hasMany(Modelcar::class, 'mark_id');
    }
    
}
