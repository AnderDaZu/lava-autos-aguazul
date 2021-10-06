<?php

namespace App\Models\Admin;

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
        'start_hour',
        'end_hour',
        'admin_id'
    ];

    public function admin(){
        return $this->belongsTo(User::class);
    }


}
