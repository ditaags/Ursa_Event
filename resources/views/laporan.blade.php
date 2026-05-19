<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ursa Event - Data Finance</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
</head>

<body>

    <main class="main-content">

        <div class="container-box">

            <!-- HEADER -->

            <div class="header-area">

                <div>
                    <h2 class="title">
                        Data Finance
                    </h2>

                    <p class="subtitle">
                        Tampilan detail data finance dibawah ini
                    </p>
                </div>

            </div>

            <!-- ====================== -->
            <!-- CHART -->
            <!-- ====================== -->

            <div class="chart-section">

                <h3 class="section-title">
                    Grafik Tiket Terjual
                </h3>

                <div class="chart-container">

                    <canvas id="ticketChart"></canvas>

                </div>

            </div>

            <!-- ====================== -->
            <!-- DATA TIKET -->
            <!-- ====================== -->

            <div class="table-section">

                <h3 class="section-title">
                    Data Tiket & Transaksi
                </h3>

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>Nama Tiket</th>
                                <th>Kuota</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                            </tr>

                        </thead>

                        <tbody>

                            @php
                                $max = max($tikets->count(), $transaksis->count());
                            @endphp

                            @for ($i = 0; $i < $max; $i++)

                                <tr>

                                    <td>
                                        {{ $tikets[$i]->nama_tiket ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $tikets[$i]->kuota ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $tikets[$i]->kategori ?? '-' }}
                                    </td>

                                    <td>
                                        {{ isset($transaksis[$i]) ? ucfirst($transaksis[$i]->status) : '-' }}
                                    </td>

                                    <td>
                                        @if(isset($tikets[$i]))
                                            Rp {{ number_format($tikets[$i]->harga, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        @if(isset($transaksis[$i]) && $transaksis[$i]->tanggal)
                                            {{ date('d-m-Y', strtotime($transaksis[$i]->tanggal)) }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                </tr>

                            @endfor

                            @if($max == 0)

                                <tr>

                                    <td colspan="6" class="empty-data">
                                        Data belum tersedia
                                    </td>

                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- ====================== -->
            <!-- DATA FINANCE -->
            <!-- ====================== -->

            <div class="table-section">

                <h3 class="section-title">
                    Data Finance
                </h3>

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>Nama Tiket</th>
                                <th>Bagian Super Admin</th>
                                <th>Bagian Admin</th>
                                <th>Tanggal</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($financeData as $finance)

                                <tr>

                                    <td>
                                        {{ $finance->nama_tiket }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($finance->bagian_super_admin, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($finance->bagian_admin, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ date('d-m-Y', strtotime($finance->tanggal)) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="empty-data">
                                        Data finance belum tersedia
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- LOGOUT -->

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="logout-btn">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

                </button>

            </form>

        </div>

    </main>

    <!-- ====================== -->
    <!-- CHART JS -->
    <!-- ====================== -->

    <script>

    const ctx = document.getElementById('ticketChart');

    const chartLabels = @json($chartLabels);

    const chartData = @json($chartData);

    /*
    |--------------------------------------------------------------------------
    | WARNA RANDOM
    |--------------------------------------------------------------------------
    */

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

                label: 'Jumlah Tiket Terjual',

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

                        stepSize: 1,

                        precision: 0,

                        color: '#111111',

                        callback: function(value) {

                            if (Number.isInteger(value)) {
                                return value;
                            }

                        }

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

</body>
</html>