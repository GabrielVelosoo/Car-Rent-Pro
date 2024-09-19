<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'car_id',
        'start_date_period',
        'expected_end_date_period',
        'actual_end_date_period',
        'daily_rate',
        'initial_km',
        'final_km'
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function car()
    {  
        return $this->belongsTo('App\Models\Car');
    }
}
