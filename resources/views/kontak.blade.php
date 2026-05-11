@extends('layouts.app')

@section('content')

@php

use Illuminate\Support\Facades\File;

$base = storage_path('app/content/');

$alamat = File::exists($base.'alamat.txt') ? File::get($base.'alamat.txt') : '';
$linkalamat = File::exists($base.'linkalamat.txt') ? File::get($base.'linkalamat.txt') : '#';

$wa = File::exists($base.'wa.txt') ? File::get($base.'wa.txt') : '';
$linkwa = File::exists($base.'linkwa.txt') ? File::get($base.'linkwa.txt') : '#';

$email = File::exists($base.'email.txt') ? File::get($base.'email.txt') : '';
$linkemail = File::exists($base.'linkemail.txt') ? File::get($base.'linkemail.txt') : '#';

$ig = File::exists($base.'ig.txt') ? File::get($base.'ig.txt') : '';
$linkig = File::exists($base.'linkig.txt') ? File::get($base.'linkig.txt') : '#';

$tt = File::exists($base.'tt.txt') ? File::get($base.'tt.txt') : '';
$linktt = File::exists($base.'linktt.txt') ? File::get($base.'linktt.txt') : '#';

@endphp

<div class="contact-page-container">

    <header class="contact-header">
        <h1>Kontak Kami</h1>
        <p>Hubungi tim kami untuk informasi lebih lanjut mengenai layanan Ursa Event.</p>
    </header>

    <div class="contact-grid-modern">

        <!-- ALAMAT -->
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>

            <h3>Alamat Kantor</h3>

            <p>{{ $alamat }}</p>

            <a href="{{ $linkalamat }}" target="_blank"
                class="info-label" style="text-decoration:none;">
                Kunjungi Kami
            </a>
        </div>

        <!-- WHATSAPP -->
        <div class="info-card">
            <div class="info-icon"><i class="fab fa-whatsapp"></i></div>

            <h3>WhatsApp</h3>

            <p>{{ $wa }}</p>

            <a href="{{ $linkwa }}" target="_blank"
                class="info-label" style="text-decoration:none;">
                Hubungi Kami
            </a>
        </div>

        <!-- EMAIL -->
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-envelope"></i></div>

            <h3>Email</h3>

            <p>{{ $email }}</p>

            <a href="{{ $linkemail }}" target="_blank"
                class="info-label" style="text-decoration:none;">
                Kirim Email
            </a>
        </div>

        <!-- INSTAGRAM -->
        <div class="info-card">
            <div class="info-icon"><i class="fab fa-instagram"></i></div>

            <h3>Instagram</h3>

            <p>{{ $ig }}</p>

            <a href="{{ $linkig }}" target="_blank"
                class="info-label" style="text-decoration:none;">
                Follow Kami
            </a>
        </div>

        <!-- TIKTOK -->
        <div class="info-card">
            <div class="info-icon"><i class="fab fa-tiktok"></i></div>

            <h3>TikTok</h3>

            <p>{{ $tt }}</p>

            <a href="{{ $linktt }}" target="_blank"
                class="info-label" style="text-decoration:none;">
                Lihat Konten
            </a>
        </div>

    </div>

</div>

@endsection