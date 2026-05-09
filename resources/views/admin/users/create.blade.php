@extends('admin_master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-tambah-event.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2>Tambah Admin</h2>
        <p>Tambahkan akun admin baru.</p>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="input-group">
            <label>Nama</label>
            <input type="text" name="name" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.users.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan</button>
        </div>
    </form>
</div>
@endsection