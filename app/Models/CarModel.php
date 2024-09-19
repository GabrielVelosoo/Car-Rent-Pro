<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
        'image',
        'number_ports',
        'places',
        'air_bag',
        'abs'
    ];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function cars()
    {
        return $this->hasMany('App\Models\Car');
    }
}
