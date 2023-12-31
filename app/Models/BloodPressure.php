<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodPressure extends Model
{
    protected $fillable = [
        'device_id',
        'user_id',
        'systolic',
        'diastolic',
        'classification',
        'comments',
        'measurement_date',
        'measurement_time',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
