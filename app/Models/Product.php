<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'price'
    ];

    public function weather_conditions()
    {
        return $this->belongsToMany(WeatherCondition::class);
    }
}
