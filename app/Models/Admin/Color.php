<?php

namespace App\Models\Admin;

use App\Models\Api\v1\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
