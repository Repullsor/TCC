<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiabetesMeasurement extends Model
{
    protected $fillable = [
        'device_id',
        'user_id',
        'glucose_level',
        'classification',
        'comments',
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
