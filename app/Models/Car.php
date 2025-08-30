<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'car_type_id',
        'model',
        'year',
        'license_plate',
        'color',
        'capacity',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'description',
        'features',
        'image',
        'available',
        'maintenance_status',
    ];

    protected $casts = [
        'features' => 'array',
        'available' => 'boolean',
        'maintenance_status' => 'boolean',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    // public function bookings()
    // {
    //     return $this->hasMany(Booking::class);
    // }

    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }

    // public function maintenances()
    // {
    //     return $this->hasMany(Maintenance::class);
    // }
}