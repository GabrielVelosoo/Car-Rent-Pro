<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'car_plate',
        'available',
        'km'
    ];

    public function carModel()
    {
        return $this->belongsTo('App\Models\CarModel');
    }
}
