@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Akun Saya</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Email:</strong> <span id="accountEmail"></span></p>
            <p><strong>Nama:</strong> <span id="accountName"></span></p>
            <button id="logoutBtn" class="btn btn-danger">Logout</button>
        </div>
    </div>
</div>

<script type="module">
    import { getAuth, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";

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

    const accountEmail = document.getElementById("accountEmail");
    const accountName = document.getElementById("accountName");
    const navUserEmail = document.getElementById("navUserEmail");
    const logoutBtn = document.getElementById("logoutBtn");

    onAuthStateChanged(auth, (user) => {
        if (user) {
            accountEmail.textContent = user.email;
            accountName.textContent = user.displayName ?? '-';
            if(navUserEmail) navUserEmail.textContent = user.email;
        } else {
            window.location.href = "/"; // redirect kalau belum login
        }
    });

    // 🔹 Logout
    logoutBtn.addEventListener("click", async () => {
        await signOut(auth);
        localStorage.removeItem("user_email");
        window.location.href = "/";
    });
</script>
@endsection
