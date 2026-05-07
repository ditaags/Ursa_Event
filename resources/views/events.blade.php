@extends('layouts.app')

@section('content')
<div class="events-page-container">
    <header class="events-header">
        <h1>Semua Event</h1>
        <p>Temukan berbagai event teknologi dan inovasi digital menarik di sini.</p>
    </header>

    <div class="events-list-wrapper">
        <a href="/event/1" class="event-item-card">
            <div class="event-item-poster">
                <img src="{{ asset('images/poster.jpg') }}" alt="Event Poster">
            </div>
            <div class="event-item-details">
                <h2 class="event-item-title">Temu Kangen Alumni – Reuni Akbar Angkatan One to Four</h2>
                <div class="event-item-meta">
                    <span class="meta-date">📅 30 Nov 2025</span>
                    <span class="meta-price">Rp30.000</span>
                </div>
                <p class="event-item-excerpt">
                    Ajang berkumpul kembali bagi seluruh lulusan SMA Islam Terpadu Walisongo untuk mengenang masa sekolah...
                </p>
                <div class="event-item-footer">
                    <img src="{{ asset('images/logo-org.png') }}" alt="Org" class="mini-logo">
                    <span>GPAN Regional Kediri</span>
                </div>
            </div>
        </a>
        </div>
</div>
@endsection