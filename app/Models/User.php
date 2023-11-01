<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'address',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'cep',
        'phone_number',
        'email',
        'cpf',
        'height',
        'weight',
        'allergies',
        'medical_conditions',
        'device_id',
        'profile_picture',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
