<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard | URSA EVENT</title>
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
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