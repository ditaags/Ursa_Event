@extends('layouts.app')

@section('content')
    {{-- Hero Section dengan Overlay yang lebih gelap agar teks terbaca --}}
    <section class="hero-section">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Platform resmi untuk informasi event kami yang bergerak di bidang teknologi dan inovasi digital.</h1>
                <a href="/events" class="btn-eksplorasi">Eksplorasi Event</a>
            </div>
        </div>
    </section>

    {{-- Gunakan Container yang sama dengan halaman Kontak/Event agar Sejajar Kiri --}}
    <section class="events-page-container">
        <h2 class="section-title">Rekomendasi Event</h2>
        
        <div class="rekomendasi-grid">
            @include('components.view', [
                'image' => asset('images/poster.jpg'),
                'title' => 'NORTH LIVE FESTIVAL VOL. 1',
                'date' => '30 Mei 2026',
                'price' => '99.000',
                'organizerLogo' => asset('images/logo1.png'),
                'organizerName' => 'ONE LIVE Indonesia'
            ])

            @include('components.view', [
                'image' => asset('images/poster.jpg'),
                'title' => 'LIVE ARENA 2026',
                'date' => '31 Mei 2026',
                'price' => '132.433',
                'organizerLogo' => asset('images/logo2.png'),
                'organizerName' => 'Nocturnal Blazze'
            ])
        </div>
    </section>

    {{-- Download App Section --}}
    <section class="download-app-section">
        <div class="download-container">
            <div class="download-content">
                <p class="download-text">
                    Untuk pembelian tiket acara, silakan gunakan aplikasi mobile resmi kami yang dapat diunduh melalui tautan di bawah ini.
                </p>
                <a href="#" class="btn-download">Download</a>
                <p class="download-info">
                    Aplikasi ini memudahkan Anda dalam melakukan pemesanan tiket, mendapatkan informasi event terbaru, dan menikmati proses transaksi yang cepat serta aman.
                </p>
            </div>
        </div>
    </section>
@endsection