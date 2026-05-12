@extends('admin_master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-tambah-event.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2>Buat Event Baru</h2>
        <p>Isi detail informasi event yang akan ditampilkan di website.</p>
    </div>

    @if ($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">

            <div class="input-group">
                <label>Nama Event</label>
                <input
                    type="text"
                    name="nama_event"
                    placeholder="Contoh: Workshop Laravel URSA"
                    value="{{ old('nama_event') }}"
                    required
                >
            </div>

            <div class="input-row">

                <div class="input-group">
                    <label>Tanggal</label>
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal') }}"
                        required
                    >
                </div>

                <div class="input-group">
                    <label>Jam</label>
                    <input
                        type="time"
                        name="jam"
                        value="{{ old('jam') }}"
                        required
                    >
                </div>

            </div>

            <div class="input-group">
                <label>Deskripsi Event</label>

                <textarea
                    name="deskripsi"
                    rows="5"
                    placeholder="Jelaskan detail event di sini..."
                    required
                >{{ old('deskripsi') }}</textarea>
            </div>

            <div class="input-group">
                <label>Poster Event (Gambar)</label>

                <input
                    type="file"
                    name="foto"
                    accept="image/*"
                >

                <small>Format: JPG, PNG, WEBP (Maks 2MB)</small>
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('admin.events.index') }}" class="btn-cancel">
                Batal
            </a>

            <button type="submit" class="btn-save">
                Simpan Event
            </button>
        </div>
    </form>
</div>
@endsection