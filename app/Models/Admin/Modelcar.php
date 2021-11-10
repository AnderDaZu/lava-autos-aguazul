<?php

namespace App\Models\Admin;

use App\Models\Api\v1\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelcar extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'name';
    }

    protected $fillable = [
        'name',
        'mark_id',
        'type_id'
    ]; 

    public function mark(){
        return $this->belongsTo(Mark::class);
    }

    public function type(){
        return $this->belongsTo(Type::class); 
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
    
}
