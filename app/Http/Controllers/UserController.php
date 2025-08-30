<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class UserController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    // 🔹 Menampilkan daftar booking/order user yang sedang login
    public function myBookings()
    {
        $user = Auth::user();

        // Ambil booking user beserta relasi mobil
        $bookings = Booking::with('car')
            ->where('user_id', $user->id)
            ->orderBy('start_date', 'desc')
            ->get();

        return view('user.bookings', compact('bookings'));
    }
}
