<?php

use Illuminate\Support\Facades\Route;
use App\Models\Car;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\FirebaseLoginController;
use App\Http\Controllers\AdminController;



Route::post('/firebase-login', [FirebaseLoginController::class, 'login'])->name('firebase.login');
Route::get('/booking/{car}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/account', [UserController::class, 'index'])->name('account');
Route::get('/', function () {
    // Ambil semua mobil beserta brand & tipe nya
    $cars = Car::with(['brand', 'carType'])->get();

    // Tampilkan ke view home.blade.php
    return view('home', compact('cars'));
});

Route::middleware('auth')->group(function () {
    // Halaman "Akun Saya"
    Route::get('/account', [UserController::class, 'index'])->name('user.index');

    // Jika mau halaman list booking
    Route::get('/my-bookings', [UserController::class, 'myBookings'])->name('user.bookings');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
