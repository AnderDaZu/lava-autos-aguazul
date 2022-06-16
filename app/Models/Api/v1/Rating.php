<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['assessment', 'comment', 'task_id'];

    public function task(){
        return $this->belongsTo(Task::class,);
    }
}
