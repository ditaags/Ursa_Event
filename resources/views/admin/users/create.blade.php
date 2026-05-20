@extends('admin_master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-tambah-event.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="form-header">
        <h2>Tambah User</h2>
        <p>Tambahkan akun baru ke sistem.</p>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            {{-- USERNAME --}}
            <div class="input-group">
                <label>Username</label>
                <input 
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    required
                >
            </div>

            {{-- EMAIL --}}
            <div class="input-group">
                <label>Email</label>
                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            {{-- PASSWORD --}}
            <div class="input-group">
                <label>Password</label>
                <input 
                    type="password"
                    name="password"
                    required
                >
            </div>
{{-- LEVEL --}}
@if(Auth::user()->level === 'superadmin')

    <div class="input-group">
        <label>Level</label>

        <select name="level" required>

            <option value="">-- Pilih Level --</option>

            <option value="superadmin"
                {{ old('level') == 'superadmin' ? 'selected' : '' }}>
                Super Admin
            </option>

            <option value="admin"
                {{ old('level') == 'admin' ? 'selected' : '' }}>
                Admin
            </option>

            <option value="finance"
                {{ old('level') == 'finance' ? 'selected' : '' }}>
                Finance
            </option>

            <option value="user"
                {{ old('level') == 'user' ? 'selected' : '' }}>
                User
            </option>

        </select>
    </div>

@elseif(Auth::user()->level === 'admin')

    {{-- otomatis user --}}
    <input type="hidden" name="level" value="user">

@endif

        <div class="form-actions">
            <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                Batal
            </a>

            <button type="submit" class="btn-save">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection