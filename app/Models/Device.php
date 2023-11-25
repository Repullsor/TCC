<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'type',
        'brand',
        'model',
        'diabetes_id',
        'blood_pressure_id',
    ];

    public function diabetes()
    {
        return $this->belongsTo(Diabetes::class, 'diabetes_id');
    }

    public function bloodPressure()
    {
        return $this->belongsTo(BloodPressure::class, 'blood_pressure_id');
    }
}
