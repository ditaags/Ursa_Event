@extends('layouts.app')

@section('content')
<div class="contact-page-container">
    <header class="contact-header">
        <h1>Kontak Kami</h1>
        <p>Hubungi tim kami untuk informasi lebih lanjut mengenai layanan Ursa Event.</p>
    </header>

    <div class="contact-grid-modern">
        <!-- Kartu Alamat -->
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
            <h3>Alamat Kantor</h3>
            <p>Gedung M.R Estnas, Jl. Teknologi Digital, Kota Inovasi.</p>
            <span class="info-label">Kunjungi Kami</span>
        </div>

        <!-- Kartu WhatsApp -->
        <div class="info-card">
            <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
            <h3>WhatsApp</h3>
            <p>+62 812 3456 789</p>
            <p class="info-subtext">Respon cepat di jam kerja (08.00 - 17.00).</p>
        </div>

        <!-- Kartu Email -->
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-envelope"></i></div>
            <h3>Email Resmi</h3>
            <p>hubungi@ursa-event.com</p>
            <p class="info-subtext">Kami akan membalas email Anda dalam 1x24 jam.</p>
        </div>

        <!-- TAMBAHKAN DI SINI: Kartu Instagram -->
        <div class="info-card">
            <div class="info-icon"><i class="fab fa-instagram"></i></div>
            <h3>Instagram</h3>
            <p>@ursa.event</p>
            <p class="info-subtext">Ikuti kegiatan seru kami setiap hari.</p>
            <a href="https://instagram.com/ursa.event" target="_blank" class="info-label" style="text-decoration: none;">Follow Kami</a>
        </div>

        <!-- TAMBAHKAN DI SINI: Kartu TikTok -->
        <div class="info-card">
            <div class="info-icon"><i class="fab fa-tiktok"></i></div>
            <h3>TikTok</h3>
            <p>@ursa.event</p>
            <p class="info-subtext">Tonton update event terbaru kami.</p>
            <a href="https://tiktok.com/@ursa.event" target="_blank" class="info-label" style="text-decoration: none;">Lihat Konten</a>
        </div>
    </div>
</div>
@endsection