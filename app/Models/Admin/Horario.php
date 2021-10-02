<?php

namespace App\Models\Admin;

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

    // Relación uno a muchos
    public function users(){
        return $this->hasMany(User::class,'id');
    }

}
