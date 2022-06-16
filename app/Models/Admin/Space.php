<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = ['start_hour', 'end_hour', 'group', 'horario_id', 'duration_id', 'times_taken'];

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }
}
