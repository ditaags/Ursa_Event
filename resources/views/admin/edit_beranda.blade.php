@extends('admin_master')

@section('content')
<div class="form-container">
    <h2>Edit Konten Beranda</h2>
    
    <form action="{{ route('admin.update_beranda') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="input-group">
            <label>Judul Utama</label>
            <input type="text" name="title" value="{{ old('title', $content->title) }}">
        </div>

        <div class="input-group">
            <label>Syarat & Ketentuan</label>
            <textarea name="terms" rows="5" placeholder="Tuliskan poin-poin syarat dan ketentuan...">{{ old('terms', $content->terms) }}</textarea>
        </div>

        <div class="input-group">
            <label>Kebijakan & Privasi</label>
            <textarea name="rules" rows="5" placeholder="Tuliskan poin-poin kebijakan privasi...">{{ old('rules', $content->rules) }}</textarea>
        </div>

        <div class="input-group">
            <label>Foto Cover</label>
            @if($content->image)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/home/' . $content->image) }}" width="200" style="border-radius: 8px;">
                    <p style="font-size: 12px; color: gray;">Foto saat ini</p>
                </div>
            @endif
            <input type="file" name="image">
        </div>

        <button type="submit" class="btn-save">Simpan Perubahan</button>
    </form>
</div>
@endsection