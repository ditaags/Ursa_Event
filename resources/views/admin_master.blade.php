<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard | URSA EVENT</title>

    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit-beranda.css') }}">

    {{-- CSS tambahan dari halaman --}}
    @stack('styles')
</head>
<body>
    <div class="dashboard-container">
        @include('admin.sidebar')

        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html>