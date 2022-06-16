<?php

namespace App\Models\Api\v1;

use App\Models\Admin\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnscheduledTask extends Model
{
    use HasFactory;

    protected $fillable = ['plate', 'price', 'stocktaking', 'finished', 'employee_id', 'yardManager_id', 'servicio_id'];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function yardManager()
    {
        return $this->belongsTo(User::class, 'yardManager_id');
    } 

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    } 
}
