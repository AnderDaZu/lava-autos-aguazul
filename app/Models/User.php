<?php

namespace App\Models;

use App\Models\Admin\Agenda;
use App\Models\Admin\Horario;
use App\Models\Admin\State;
use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Task;
use App\Models\Api\v1\Vehicle;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_name',
        'name',
        'last_name',
        'birthdate',
        'identification',
        'phone',
        'email',
        'password',
        'state_id', 
        'user_id',
        // 'horario_id'
    ];

    public function getRouteKeyName()
    {
        return "user_name";
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Relación uno a muchos (inversa)
    // public function horario(){
    //     return $this->belongsTo(Horario::class, 'horario_id');
    // }

    // Relación uno a muchos (inversa)
    public function state(){
        return $this->belongsTo(State::class, 'state_id');
    }

    public function agendas(){ 
        return $this->hasMany(Agenda::class, 'admin_id');
    }

    public function agendasEmployee(){
        return $this->hasMany(Agenda::class, 'employee_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
