<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherCondition extends Model
{
    use HasFactory;

    protected $fillable = ['condition'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
