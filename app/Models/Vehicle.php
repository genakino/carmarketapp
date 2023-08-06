<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'make',
        'model',
        'year',
        'mileage',
        'gearbox',
        'fuel_type',
        'color',
        'image',
        'delete_flg'
    ];
}
