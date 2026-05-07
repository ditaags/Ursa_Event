<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ursa Event</title>

    {{-- 1. FontAwesome untuk Ikon (PENTING untuk halaman Kontak) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- 2. Google Fonts (Opsional agar tampilan lebih modern) --}}
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
    <header class="main-header">
        <div class="container-header">
            <div class="logo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Ursa Logo">
            </div>

            <div class="header-right">
                <nav class="nav-menu">
                    <ul>
                        <li><a href="/">BERANDA</a></li>
                        <li><a href="/event">EVENT</a></li>
                        <li><a href="/kontak">KONTAK KAMI</a></li>
                    </ul>
                </nav>

               <div class="auth-buttons">

    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-login">
                LOGOUT
            </button>
        </form>
    @else
        <a href="{{ url('/login') }}" class="btn-login">
            LOGIN
        </a>
    @endauth

</div>
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
                <h3>Items</h3>
                <ul>
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/event">Event</a></li>
                    <li><a href="/privacy">Kebijakan & Privasi</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Frame</h3>
                <ul>
                    <li><a href="/terms">Syarat & Ketentuan</a></li>
                    {{-- Disamakan dengan route header (/kontak) --}}
                    <li><a href="/kontak">Kontak Kami</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Social Media</h3>
                <ul>
                    <li><a href="#"><i class="fab fa-tiktok"></i> Tiktok Ursa Event</a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram Ursa Event</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>