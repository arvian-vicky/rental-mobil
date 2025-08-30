@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Order Saya</h2>

    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->car->name ?? 'Mobil' }}</h5>
                        <p class="card-text"><strong>Tanggal Sewa:</strong> {{ $booking->start_date }}</p>
                        <p class="card-text"><strong>Tanggal Kembali:</strong> {{ $booking->end_date }}</p>
                        <p class="card-text"><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                        <p class="card-text"><strong>Total:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Pickup:</strong> {{ $booking->pickup_location }}</p>
                        <p class="card-text"><strong>Dropoff:</strong> {{ $booking->dropoff_location }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada order.</p>
        @endforelse
    </div>
</div>
@endsection
