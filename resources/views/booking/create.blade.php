@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Booking Mobil: {{ $car->brand->name }} - {{ $car->model }}</h2>

    {{-- Tombol Login Google --}}
    <div class="mb-3" id="googleLoginWrapper">
        <button type="button" id="googleLogin" class="btn btn-danger w-100 mb-2">
            <i class="bi bi-google"></i> Login dengan Google
        </button>
    </div>

    <form action="{{ route('booking.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="car_id" value="{{ $car->id }}">

        {{-- Email otomatis dari Google --}}
        <div class="mb-3">
            <label class="form-label">Email Anda</label>
            <input type="email" name="email" id="emailField" class="form-control" readonly required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Selesai</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi Pickup</label>
            <input type="text" name="pickup_location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi Dropoff</label>
            <input type="text" name="dropoff_location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan (opsional)</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Konfirmasi Booking</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- Firebase Login Script --}}
<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
  import { getAuth, GoogleAuthProvider, signInWithPopup, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

  const firebaseConfig = {
    apiKey: "AIzaSyBZe2rqgINWz3VeZtbiqAXAs3Kia6kCMOI",
    authDomain: "rental-mobil-ec579.firebaseapp.com",
    projectId: "rental-mobil-ec579",
    storageBucket: "rental-mobil-ec579.firebasestorage.app",
    messagingSenderId: "207049255912",
    appId: "1:207049255912:web:5adcf8e3654a860488925d",
    measurementId: "G-2VYT9FFT8S"
  };

  const app = initializeApp(firebaseConfig);
  const auth = getAuth(app);
  const provider = new GoogleAuthProvider();

  // 🔹 Cek status login
  onAuthStateChanged(auth, (user) => {
    const emailField = document.getElementById("emailField");
    const loginWrapper = document.getElementById("googleLoginWrapper");

    if (user) {
      // User sudah login → isi email & hide tombol Google
      emailField.value = user.email;
      loginWrapper.style.display = "none";
    } else {
      // Belum login → tampilkan tombol
      loginWrapper.style.display = "block";
    }
  });

  // 🔹 Event tombol login
  document.addEventListener("DOMContentLoaded", () => {
    const loginBtn = document.getElementById("googleLogin");
    if (loginBtn) {
      loginBtn.addEventListener("click", async () => {
        try {
          const result = await signInWithPopup(auth, provider);
          const user = result.user;

          // Simpan email
          localStorage.setItem("user_email", user.email);

          // Isi field email otomatis
          const emailField = document.getElementById("emailField");
          if (emailField) {
            emailField.value = user.email;
          }

          // Sembunyikan tombol login
          document.getElementById("googleLoginWrapper").style.display = "none";

        } catch (error) {
          console.error(error);
          alert("Login gagal: " + error.message);
        }
      });
    }
  });
</script>
@endsection
