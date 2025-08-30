<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FirebaseLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        // Login user di Laravel
        Auth::login($user);

        return response()->json(['success' => true, 'role' => $user->role]);
    }
}

