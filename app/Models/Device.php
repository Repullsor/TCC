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

    public function diabetesMeasurement()
    {
        return $this->belongsTo(DiabetesMeasurement::class, 'diabetes_id');
    }

    public function bloodPressureMeasurement()
    {
        return $this->belongsTo(BloodPressureMeasurement::class, 'blood_pressure_id');
    }
}
