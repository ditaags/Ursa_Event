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
    <header class="main-header">
        <div class="container-header">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Ursa Logo">
                </a>
            </div>

            <div class="header-right">
                <nav class="nav-menu">
                    <ul>
                        <li><a href="{{ url('/') }}">BERANDA</a></li>
                        <li><a href="{{ url('/event') }}">EVENT</a></li>
                        <li><a href="{{ url('/kontak') }}">KONTAK KAMI</a></li>
                    </ul>
                </nav>

                <div class="auth-buttons">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-login" style="cursor: pointer;">
                                LOGOUT
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">
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
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/event') }}">Event</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak Kami</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <ul>
                    <li><a href="{{ url('/terms') }}">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <ul>
                    <li><a href="{{ url('/privacy') }}">Kebijakan & Privasi</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>