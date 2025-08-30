@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-center">Daftar Mobil Tersedia</h1>

    {{-- 🔹 Info user --}}
    <div class="mb-4 text-center">
        <div id="userInfo" style="display:none;">
            <i class="bi bi-person-circle"></i>
            <span id="userEmail"></span>
        </div>
        <button type="button" id="googleLogin" class="btn btn-danger" style="display:none;">
            <i class="bi bi-google"></i> Login dengan Google
        </button>
    </div>

    <div class="row">
        @foreach($cars as $car)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    {{-- Gambar Mobil --}}
                    @if($car->image)
                        <img src="{{ asset('images/'.$car->image) }}" class="card-img-top" alt="{{ $car->model }}">
                    @else
                        <img src="https://via.placeholder.com/400x250?text=No+Image" class="card-img-top" alt="No Image">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $car->brand->name }} - {{ $car->model }}</h5>
                        <p class="card-text">
                            <strong>Tipe:</strong> {{ $car->carType->name }} <br>
                            <strong>Tahun:</strong> {{ $car->year }} <br>
                            <strong>Warna:</strong> {{ $car->color }} <br>
                            <strong>Kapasitas:</strong> {{ $car->capacity }} orang <br>
                            <strong>Harga:</strong> Rp {{ number_format($car->daily_rate,0,',','.') }}/hari
                        </p>
                        <a href="{{ route('booking.create', $car->id) }}" class="btn btn-primary">Booking</a>
                    </div>
                </div>
            </div>
        @endforeach
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

        const userInfo = document.getElementById("userInfo");
        const userEmail = document.getElementById("userEmail");
        const googleLogin = document.getElementById("googleLogin");

        // 🔹 Cek status login
        onAuthStateChanged(auth, (user) => {
            if (user) {
                // User login
                userInfo.style.display = "block";
                userEmail.textContent = user.email;
                googleLogin.style.display = "none";
            } else {
                // Belum login
                userInfo.style.display = "none";
                googleLogin.style.display = "inline-block";
            }
        });

        // 🔹 Event login Google
        googleLogin.addEventListener("click", async () => {
            try {
                const result = await signInWithPopup(auth, provider);
                const user = result.user;
                localStorage.setItem("user_email", user.email);
                alert("Login berhasil: " + user.email);
            } catch (error) {
                alert("Login gagal: " + error.message);
            }
        });
    </script>
@endsection
