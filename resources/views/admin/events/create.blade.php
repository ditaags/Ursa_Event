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

    <form action="{{ route('admin.events.index') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="input-group">
                <label>Nama Event</label>
                <input type="text" name="nama_event" placeholder="Contoh: Workshop Laravel ursa" required>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" required>
                </div>
                <div class="input-group">
                    <label>Jam</label>
                    <input type="time" name="jam" required>
                </div>
            </div>

            <div class="input-group">
                <label>Status</label>
                <select name="status">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-Aktif</option>
                </select>
            </div>

            <div class="input-group">
                <label>Deskripsi Event</label>
                <textarea name="deskripsi" rows="5" placeholder="Jelaskan detail event di sini..."></textarea>
            </div>

            <div class="input-group">
                <label>Poster Event (Gambar)</label>
                <input type="file" name="image" accept="image/*">
                <small>Format: JPG, PNG, WEBP (Maks 2MB)</small>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.events.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan Event</button>
        </div>
    </form>
</div>
@endsection