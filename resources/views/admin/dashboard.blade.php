@extends('admin_master')

@section('content')
<div class="dashboard-wrapper">
    <div class="welcome-card">
        <h1>Selamat Datang, Admin</h1>
        <p>Kelola dan pantau seluruh kegiatan <strong>Ursa Event</strong> di sini.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-info">
                <span class="number">45</span>
                <span class="label">Total Event</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-bolt"></i>
            </div>
            <div class="stat-info">
                <span class="number">12</span>
                <span class="label">Event Aktif</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <span class="number">120</span>
                <span class="label">Total Peserta</span>
            </div>
        </div>
    </div>
</div>
@endsection