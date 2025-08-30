<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Form booking
    public function create(Car $car)
    {
        return view('booking.create', compact('car'));
    }

    // Simpan booking
   public function store(Request $request)
{
    $validated = $request->validate([
        'car_id'          => 'required|exists:cars,id',
        'email'           => 'required|email',
        'start_date'      => 'required|date|after_or_equal:today',
        'end_date'        => 'required|date|after:start_date',
        'pickup_location' => 'required|string|max:255',
        'dropoff_location'=> 'required|string|max:255',
        'notes'           => 'nullable|string'
    ]);

    // 🔹 Cari mobil
    $car = Car::findOrFail($validated['car_id']);

    // 🔹 Hitung total hari & harga
    $totalDays = (new \DateTime($validated['start_date']))
        ->diff(new \DateTime($validated['end_date']))->days + 1; // +1 biar termasuk hari pertama
    $totalPrice = $totalDays * $car->daily_rate;

    // 🔹 Cari user by email, kalau belum ada buat otomatis
    $user = \App\Models\User::firstOrCreate(
        ['email' => $validated['email']],
        [
            'name' => explode('@', $validated['email'])[0],
            'password' => bcrypt(str()->random(12)),
            'role' => 'customer',
        ]
    );

    // 🔹 Simpan booking
    Booking::create([
        'user_id'         => $user->id,
        'car_id'          => $car->id,
        'start_date'      => $validated['start_date'],
        'end_date'        => $validated['end_date'],
        'pickup_location' => $validated['pickup_location'],
        'dropoff_location'=> $validated['dropoff_location'],
        'notes'           => $validated['notes'],
        'status'          => 'pending',
        'total_price'     => $totalPrice, // pastikan ini sama dengan kolom di SQL
    ]);

    return redirect('/')->with('success', 'Booking berhasil dibuat!');
}

}
