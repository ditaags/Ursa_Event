@extends('admin_master')

@section('content')

<div class="dashboard-wrapper">

    {{-- HEADER DASHBOARD --}}
    <div class="welcome-card">
        <h1>Selamat Datang, {{ Auth::user()->username }}</h1>
        <p>Kelola dan pantau seluruh kegiatan <strong>Ursa Event</strong> di sini.</p>
    </div>

    {{-- STATISTIK DASHBOARD --}}
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>

            <div class="stat-info">
                <span class="number">{{ $totalEvent }}</span>
                <span class="label">Total Event</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-bolt"></i>
            </div>

            <div class="stat-info">
                <span class="number">{{ $eventAktif }}</span>
                <span class="label">Event Aktif</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>

            <div class="stat-info">
                <span class="number">{{ $totalPengguna }}</span>
                <span class="label">Total Pengguna</span>
            </div>
        </div>

    </div>

    {{-- GRAFIK PENDAPATAN TIKET --}}
    <div class="chart-section">

        <h3 class="section-title">
            Grafik Pendapatan Tiket
        </h3>

        <div class="chart-container">
            <canvas id="ticketChart"></canvas>
        </div>

    </div>

</div>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('ticketChart');

    const chartLabels = @json($chartLabels);

    const chartData = @json($chartData);

    const backgroundColors = [
        '#e11d48',
        '#3b82f6',
        '#22c55e',
        '#f59e0b',
        '#8b5cf6',
        '#06b6d4',
        '#f97316',
        '#14b8a6',
        '#ef4444',
        '#84cc16',
        '#ec4899',
        '#6366f1'
    ];

    const borderColors = [
        '#be123c',
        '#2563eb',
        '#16a34a',
        '#d97706',
        '#7c3aed',
        '#0891b2',
        '#ea580c',
        '#0f766e',
        '#dc2626',
        '#65a30d',
        '#db2777',
        '#4f46e5'
    ];

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: chartLabels,

            datasets: [{

                label: 'Pendapatan Tiket',

                data: chartData,

                backgroundColor: chartLabels.map((_, index) =>
                    backgroundColors[index % backgroundColors.length]
                ),

                borderColor: chartLabels.map((_, index) =>
                    borderColors[index % borderColors.length]
                ),

                borderWidth: 2,

                borderRadius: 10

            }]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    labels: {
                        color: '#111111'
                    }
                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        precision: 0,
                        color: '#111111'
                    },

                    grid: {
                        color: '#eeeeee'
                    }

                },

                x: {

                    ticks: {
                        color: '#111111'
                    },

                    grid: {
                        display: false
                    }

                }

            }

        }

    });
</script>

@endsection