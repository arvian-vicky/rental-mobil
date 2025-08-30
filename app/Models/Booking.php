<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Nama tabel (opsional, tapi untuk memastikan)
    protected $table = 'bookings';

    protected $fillable = [
        'car_id',
        'user_id',       // nanti kita hubungkan dengan tabel users
        'start_date',
        'end_date',
        'pickup_location',
        'dropoff_location',
        'notes',
        'status',
        'total_price',
        'total_days',    // tambahan dari database
        'total_amount'   // tambahan dari database
    ];

    // Cast untuk konversi otomatis tipe data
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    // Relasi ke mobil
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper: cek apakah booking selesai
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Helper: cek apakah booking sedang disewa
    public function isOnRent()
    {
        return $this->status === 'on_rent';
    }
}
