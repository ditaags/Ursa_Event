@extends('admin_master')

@section('content')
<div class="form-container">
    <h2>Edit Konten Beranda</h2>

    @if(session('success'))
        <div style="background:#d4edda;padding:10px;border-radius:8px;margin-bottom:15px;color:#155724;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.update_beranda') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="input-group">
            <label>Judul Utama</label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $content->title) }}"
                required
            >
        </div>

        <div class="input-group">
            <label>Syarat & Ketentuan</label>
            <textarea
                name="terms"
                rows="6"
                placeholder="Tuliskan syarat dan ketentuan..."
            >{{ old('terms', $content->terms) }}</textarea>
        </div>

        <div class="input-group">
            <label>Kebijakan & Privasi</label>
            <textarea
                name="rules"
                rows="6"
                placeholder="Tuliskan kebijakan privasi..."
            >{{ old('rules', $content->rules) }}</textarea>
        </div>

        <div class="input-group">
            <label>Foto Hero</label>

            <div style="margin-bottom:15px;">
                <img
                    src="{{ asset('css/gedung.png') }}"
                    width="300"
                    style="border-radius:10px;"
                >
            </div>

            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn-save">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection