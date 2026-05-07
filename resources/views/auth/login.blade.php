<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - URSA EVENT</title>
    {{-- Hubungkan ke CSS khusus login --}}
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
</head>
<body>

    <div class="main-wrapper">
        <div class="login-box">
            
            {{-- Bagian Logo & Judul --}}
            <div class="header-section">
                {{-- Pastikan gambar logo-cakar.png ada di folder public/images/ --}}
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo URSA" class="main-logo">
                <h1 class="brand-name">URSA EVENT</h1>
            </div>

            {{-- Pesan Error dari Controller (blokir/salah pass) --}}
            @if ($errors->any())
                <div class="error-text">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form Login --}}
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                {{-- Input Username/Email --}}
                <div class="input-group">
                    <label for="email">Username/Email</label>
                    <div class="input-wrapper">
                        {{-- Ikon User di dalam input --}}
                        <div class="input-icon icon-user"></div>
                        <input type="text" name="email" id="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                {{-- Input Password --}}
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        {{-- Ikon Gembok di dalam input --}}
                        <div class="input-icon icon-lock"></div>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>

                {{-- Fitur Tampilkan Password --}}
                <div class="option-group">
                    <input type="checkbox" id="show-pass" onclick="togglePassword()">
                    <label for="show-pass">Tampilkan password</label>
                </div>

                {{-- Tombol Sign in Oval --}}
                <button type="submit" class="btn-sign-in">Sign in</button>
            </form>

        </div>
    </div>

    {{-- Script untuk Tampilkan Password --}}
    <script>
        function togglePassword() {
            var passInput = document.getElementById("password");
            if (passInput.type === "password") {
                passInput.type = "text";
            } else {
                passInput.type = "password";
            }
        }
    </script>

</body>
</html>