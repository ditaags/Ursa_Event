@extends('layouts.app')

@section('content')

@php
    use App\Models\Event;

    // Ambil hanya event aktif
    // Event lama di kiri → event baru di kanan
    $events = Event::where('status', 'aktif')
        ->orderBy('created_at', 'asc')
        ->get();

    $totalEvent = $events->count();
@endphp

{{-- Hero Section --}}
<section class="hero-section">

    <div class="hero-overlay">

        <div class="hero-content">

            <h1>{{ $content->title }}</h1>

            <a href="{{ url('/event') }}" class="btn-eksplorasi">
                Eksplorasi Event
            </a>

        </div>

    </div>

</section>

{{-- Rekomendasi Event --}}
<section class="events-page-container">

    <h2 class="section-title">
        Rekomendasi Event
    </h2>

    <div class="event-slider-wrapper">

        {{-- Tombol slider hanya muncul jika data banyak --}}
        @if($totalEvent > 3)

            <button
                id="scrollLeft"
                class="slider-btn left">
                ‹
            </button>

            <button
                id="scrollRight"
                class="slider-btn right">
                ›
            </button>

        @endif

        {{-- Slider --}}
       <div
    id="eventSlider"
    class="event-slider
        {{ $totalEvent <= 2 ? 'justify-center' : '' }}">

            @forelse($events as $event)

                <a
                    href="#"
                    class="event-card">

                    {{-- Poster --}}
                    <div class="event-card-image">

                        @if($event->foto)

                            <img
                                src="{{ $event->foto }}"
                                alt="{{ $event->nama_event }}">

                        @else

                            <img
                                src="{{ asset('images/poster.jpg') }}"
                                alt="{{ $event->nama_event }}">

                        @endif

                    </div>

                    {{-- Body --}}
                    <div class="event-card-body">

                        <h3>
                            {{ $event->nama_event }}
                        </h3>

                        <p class="event-meta">
                            📅
                            {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                        </p>

                        <div class="event-card-price">
                            🕒
                            {{ \Carbon\Carbon::parse($event->jam)->format('H:i') }}
                        </div>


                    </div>

                </a>

            @empty

                <div class="empty-event">

                    <h3>
                        Belum Ada Event Aktif
                    </h3>

                    <p>
                        Event yang tersedia akan tampil di sini.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- Download App Section --}}
<section class="download-app-section">

    <div class="download-container">

        <div class="download-content">

            <p class="download-text">
                Untuk pembelian tiket acara,
                silakan gunakan aplikasi mobile resmi kami
                yang dapat diunduh melalui tautan di bawah ini.
            </p>

            <a href="#" class="btn-download">
                Download
            </a>

            <p class="download-info">
                Aplikasi ini memudahkan Anda dalam melakukan pemesanan tiket,
                mendapatkan informasi event terbaru,
                dan menikmati proses transaksi yang cepat serta aman.
            </p>

        </div>

    </div>

</section>

{{-- Script Slider --}}
@if($totalEvent > 3)

<script>

    const slider = document.getElementById('eventSlider');

    document.getElementById('scrollLeft').onclick = function () {

        slider.scrollBy({
            left: -320,
            behavior: 'smooth'
        });

    };

    document.getElementById('scrollRight').onclick = function () {

        slider.scrollBy({
            left: 320,
            behavior: 'smooth'
        });

    };

</script>

@endif

@endsection