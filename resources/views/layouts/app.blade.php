<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental Mobil</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- 🔹 Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Rental Mobil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('cars') ? 'active' : '' }}" href="{{ url('/cars') }}">Mobil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('bookings') ? 'active' : '' }}" href="{{ url('/bookings') }}">Booking</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Kontak</a>
    </li>

    {{-- 🔹 Akun Saya --}}
 <li class="nav-item">
        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Kontak</a>
    </li>



</ul>


            </div>
        </div>
    </nav>

    {{-- 🔹 Konten Halaman --}}
    <div class="container py-4">
        @yield('content')
    </div>

    {{-- 🔹 Footer --}}
    <footer class="bg-dark text-white py-3 mt-5">
        <div class="container text-center">
            <p class="mb-2">&copy; {{ date('Y') }} Rental Mobil. All rights reserved.</p>
            
            {{-- Tombol WhatsApp --}}
            <a href="https://wa.me/6281234567890" 
               target="_blank" 
               class="btn btn-success">
                <i class="bi bi-whatsapp"></i> Chat via WhatsApp
            </a>
            
            <div class="mt-2">
                <small>
                    <a href="{{ url('/contact') }}" class="text-white text-decoration-none">Hubungi Kami</a> | 
                    <a href="{{ url('/about') }}" class="text-white text-decoration-none">Tentang</a>
                </small>
            </div>
        </div>
    </footer>
    {{-- 🔹 Floating WhatsApp --}}
    <a href="https://api.whatsapp.com/send?phone=6285781879570&text=Halo%2C%20saya%20ingin%20booking%20mobil" 
       target="_blank" 
       class="whatsapp-float">
        <i class="bi bi-whatsapp"></i>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 32px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .whatsapp-float:hover {
            transform: translateY(-50%) scale(1.1);
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Firebase App (Core SDK) -->
<script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Config dari Firebase Console (Project Settings → General → Web App)
  const firebaseConfig = {
    apiKey: "AIzaSyBZe2rqgINWz3VeZtbiqAXAs3Kia6kCMOI",
    authDomain: "rental-mobil-ec579.firebaseapp.com",
    projectId: "rental-mobil-ec579",
    storageBucket: "rental-mobil-ec579.firebasestorage.app",
    messagingSenderId: "207049255912",
    appId: "1:207049255912:web:5adcf8e3654a860488925d",
    measurementId: "G-2VYT9FFT8S"
  };

  // Inisialisasi Firebase
  const app = firebase.initializeApp(firebaseConfig);
  const auth = firebase.auth();
</script>

<script type="module">
import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

const auth = getAuth();

// 🔹 Cek status login Google
onAuthStateChanged(auth, (user) => {
  if (user) {
    document.getElementById("loginMenu").style.display = "none";
    document.getElementById("userMenu").style.display = "block";
    document.getElementById("userEmail").textContent = user.email;
  } else {
    document.getElementById("loginMenu").style.display = "block";
    document.getElementById("userMenu").style.display = "none";
  }
});
</script>


</body>
</html>
