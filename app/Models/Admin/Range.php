<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory;

    protected $fillable = ['start', 'end'];

    public function scheduled_spaces(){
        return $this->hasMany(ScheduledSpace::class);
    }
}
