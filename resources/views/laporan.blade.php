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
                    Grafik Pendapatan Tiket
                </h3>

                <div class="chart-container">

                    <canvas id="ticketChart"></canvas>

                </div>

            </div>

            <!-- ====================== -->
            <!-- DATA TIKET & TRANSAKSI -->
            <!-- ====================== -->

            <div class="table-section">

                <h3 class="section-title">
                    Data Tiket & Transaksi
                </h3>

                <!-- TOP ACTION -->

                <div class="top-action">

                    <!-- DOWNLOAD BUTTON -->

                    <a href="{{ route('download.excel') }}" class="download-btn">

                        <i class="fa-solid fa-file-excel"></i>

                        Download Excel

                    </a>

                    <!-- SEARCH -->

                    <div class="search-box">

                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Cari nama tiket, kategori, status, tanggal..."
                        >

                        <i class="fa-solid fa-magnifying-glass"></i>

                    </div>

                </div>

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

                        <tbody id="transactionTableBody">

                            @foreach ($transaksis as $index => $transaksi)

                                <tr
                                    class="transaction-row"
                                    data-index="{{ $index }}"
                                >

                                    <td>
                                        {{ $transaksi->nama_tiket }}
                                    </td>

                                    <td>
                                        {{ $transaksi->kuota }}
                                    </td>

                                    <td>
                                        {{ $transaksi->kategori }}
                                    </td>

                                    <td>
                                        {{ ucfirst($transaksi->status) }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($transaksi->harga, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ date('d-m-Y', strtotime($transaksi->tanggal)) }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <!-- SLIDER BUTTON -->

                <div class="slider-buttons">

                    <button type="button" id="prevSlide">

                        <i class="fa-solid fa-chevron-left"></i>

                    </button>

                    <button type="button" id="nextSlide">

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>

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
                                <th>Pendapatan</th>
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
                                        Rp {{ number_format($finance->pendapatan, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ date('d-m-Y', strtotime($finance->tanggal)) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="empty-data">
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

    <!-- ====================== -->
    <!-- SLIDER + SEARCH -->
    <!-- ====================== -->

    <script>

        const rows = Array.from(document.querySelectorAll('.transaction-row'));

        const searchInput = document.getElementById('searchInput');

        const rowsPerSlide = 10;

        let currentSlide = 0;

        let filteredRows = [...rows];

        /*
        |--------------------------------------------------------------------------
        | SHOW SLIDE
        |--------------------------------------------------------------------------
        */

        function showSlide(slideIndex){

            rows.forEach(row => {
                row.style.display = 'none';
            });

            const start = slideIndex * rowsPerSlide;

            const end = start + rowsPerSlide;

            filteredRows.slice(start, end).forEach(row => {
                row.style.display = '';
            });

        }

        /*
        |--------------------------------------------------------------------------
        | INITIAL
        |--------------------------------------------------------------------------
        */

        showSlide(currentSlide);

        /*
        |--------------------------------------------------------------------------
        | NEXT
        |--------------------------------------------------------------------------
        */

        document.getElementById('nextSlide')
            .addEventListener('click', () => {

                const totalSlides = Math.ceil(filteredRows.length / rowsPerSlide);

                currentSlide++;

                if(currentSlide >= totalSlides){
                    currentSlide = 0;
                }

                showSlide(currentSlide);

            });

        /*
        |--------------------------------------------------------------------------
        | PREV
        |--------------------------------------------------------------------------
        */

        document.getElementById('prevSlide')
            .addEventListener('click', () => {

                const totalSlides = Math.ceil(filteredRows.length / rowsPerSlide);

                currentSlide--;

                if(currentSlide < 0){
                    currentSlide = totalSlides - 1;
                }

                showSlide(currentSlide);

            });

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener('keyup', function(){

            const keyword = this.value.toLowerCase();

            filteredRows = rows.filter(row => {

                return row.innerText.toLowerCase().includes(keyword);

            });

            currentSlide = 0;

            showSlide(currentSlide);

        });

    </script>

</body>
</html>