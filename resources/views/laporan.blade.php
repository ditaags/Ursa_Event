<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ursa Event - Data Finance</title>

    <script src="https://cdn.tailwindcss.com"></script>

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
                    <h2 class="title">Data Finance</h2>

                    <p class="subtitle">
                        Tampilan detail data finance dibawah ini
                    </p>
                </div>

            </div>

            <!-- ====================== -->
            <!-- DATA TIKET + TRANSAKSI -->
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
                                <th>Sub Total</th>
                                <th>Tanggal Transaksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @php
                                $max = max($tikets->count(), $transaksis->count());
                            @endphp

                            @for ($i = 0; $i < $max; $i++)

                                <tr>

                                    <!-- DATA TIKET -->

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
                                        {{ isset($tikets[$i]) ? ucfirst($tikets[$i]->status) : '-' }}
                                    </td>

                                    <td>
                                        @if(isset($tikets[$i]))
                                            Rp {{ number_format($tikets[$i]->harga, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <!-- DATA TRANSAKSI -->

                                    <td>
                                        @if(isset($transaksis[$i]))
                                            Rp {{ number_format($transaksis[$i]->sub_total, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        @if(isset($transaksis[$i]))
                                            {{ date('d-m-Y', strtotime($transaksis[$i]->tanggal)) }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                </tr>

                            @endfor

                            @if($max == 0)

                                <tr>
                                    <td colspan="7" class="empty-data">
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
                                <th>Bagian Super Admin</th>
                                <th>Bagian Admin</th>
                                <th>Tanggal</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($finances as $finance)

                                <tr>

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
                                    <td colspan="3" class="empty-data">
                                        Data finance belum tersedia
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

             <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
        </div>

    </main>

</body>
</html>