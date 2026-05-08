@extends('admin_master')

@section('content')
<div class="welcome-card">
    <h1>Edit Konten Beranda</h1>
    <p>Sesuaikan teks yang muncul di halaman utama pengunjung.</p>
</div>

<div class="stat-card" style="text-align: left;"> {{-- Menggunakan class stat-card agar seragam --}}
    <form action="{{ route('admin.update_beranda') }}" method="POST">
        @csrf
        <div style="margin-bottom: 20px;">
            <label style="display:block; margin-bottom: 8px; font-weight: 600;">Judul Utama</label>
            <input type="text" name="title" value="{{ $content->title }}" 
                style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; margin-bottom: 8px; font-weight: 600;">Deskripsi</label>
            <textarea name="description" rows="5" 
                style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">{{ $content->description }}</textarea>
        </div>

        <button type="submit" 
            style="background: #38bdf8; color: white; border: none; padding: 12px 25px; border-radius: 10px; cursor: pointer; font-weight: 600;">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection