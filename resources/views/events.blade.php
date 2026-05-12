@extends('layouts.app')

@section('content')

@php
    use App\Models\Event;

    // Ambil hanya event dengan status aktif
    $events = Event::where('status', 'aktif')
        ->orderBy('tanggal', 'asc')
        ->get();
@endphp

<div class="events-page-container">

    <header class="events-header">
        <h1>Semua Event</h1>
        <p>
            Temukan berbagai event teknologi dan inovasi digital menarik di sini.
        </p>
    </header>

    <div class="events-list-wrapper">

        @forelse($events as $event)

        <a href="#" class="event-item-card">

            <div class="event-item-poster">

                @if($event->foto)
                    <img
                        src="{{ $event->foto }}"
                        alt="Event Poster"
                    >
                @else
                    <img
                        src="{{ asset('images/poster.jpg') }}"
                        alt="Event Poster"
                    >
                @endif

            </div>

            <div class="event-item-details">

                <h2 class="event-item-title">
                    {{ $event->nama_event }}
                </h2>

                <div class="event-item-meta">

                    <span class="meta-date">
                        📅 {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}
                    </span>

                    <span class="meta-price">
                        🕒 {{ \Carbon\Carbon::parse($event->jam)->format('H:i') }}
                    </span>

                </div>

                <p class="event-item-excerpt">
                    {{ \Illuminate\Support\Str::limit($event->deskripsi, 150) }}
                </p>

            </div>

        </a>

        @empty

        <div style="
            width:100%;
            text-align:center;
            padding:40px;
            background:white;
            border-radius:12px;
        ">
            <h3>Belum Ada Event Aktif</h3>
            <p>Event yang tersedia akan muncul di sini.</p>
        </div>

        @endforelse

    </div>

</div>

@endsection