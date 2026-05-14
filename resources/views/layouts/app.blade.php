@php
use Illuminate\Support\Facades\File;

$base = storage_path('app/content/');

$footerContent = (object)[
    'terms' => File::exists($base . 'terms.txt')
        ? File::get($base . 'terms.txt')
        : '',

    'rules' => File::exists($base . 'rules.txt')
        ? File::get($base . 'rules.txt')
        : '',
];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ursa Event</title>

    {{-- 1. FontAwesome untuk Ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- 2. Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    {{-- 3. CSS Files --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/event-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/event-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body style="font-family: 'Inter', sans-serif;">

    {{-- Bagian Header --}}
    <header class="main-header navbar">
        <div class="container-header nav-container">
            {{-- Logo ini akan otomatis hilang di HP jika CSS .logo { display: none } aktif --}}
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Ursa Logo" class="main-logo">
                </a>
            </div>

            <div class="header-right">
                {{-- Tombol Hamburger (Akan berada di kanan karena justify-content: flex-end di CSS) --}}
                <button class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <nav class="nav-menu" id="nav-menu">
                    {{-- Header Sidebar: Muncul hanya saat Sidebar dibuka di HP --}}
                    <div class="sidebar-header">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Ursa Logo" class="sidebar-logo">
                        <button class="close-btn" id="close-btn">&times;</button>
                    </div>

                    <ul>
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> BERANDA</a></li>
                        <li><a href="{{ url('/event') }}"><i class="fas fa-calendar-alt"></i> EVENT</a></li>
                        <li><a href="{{ url('/kontak') }}"><i class="fas fa-phone"></i> KONTAK KAMI</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    {{-- Bagian Konten Dinamis --}}
    <main>
        @yield('content')
    </main>

    {{-- Bagian Footer --}}
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-column">
                <p class="footer-description">
                    © 2026 Ursa Event. <br>
                    Inovasi teknologi untuk pengalaman event terbaik.
                </p>
            </div>

            <div class="footer-column">
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/event') }}">Event</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak Kami</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <ul>
                    <li>
                        <strong>Syarat & Ketentuan</strong><br>
                        {{ $footerContent->terms }}
                    </li>
                </ul>
            </div>

            <div class="footer-column">
                <ul>
                    <li>
                        <strong>Kebijakan & Privasi</strong><br>
                        {{ $footerContent->rules }}
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    {{-- Script JavaScript --}}
    <script>
        const hamburger = document.getElementById('hamburger');
        const closeBtn = document.getElementById('close-btn');
        const navMenu = document.getElementById('nav-menu');

        // Buka Menu
        hamburger.addEventListener('click', () => {
            navMenu.classList.add('active');
            hamburger.classList.add('is-active');
        });

        // Tutup Menu via tombol X
        closeBtn.addEventListener('click', () => {
            navMenu.classList.remove('active');
            hamburger.classList.remove('is-active');
        });

        // Menutup menu jika klik di luar area sidebar
        document.addEventListener('click', (e) => {
            if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
                navMenu.classList.remove('active');
                hamburger.classList.remove('is-active');
            }
        });
    </script>

</body>
</html>