@extends('admin_master')

@section('content')
<!-- Memanggil file CSS eksternal -->
<link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">

<div class="admin-container">
    <div class="admin-header">
        <h2 style="color: #e63946;">Daftar Admin Ursa</h2>
        <a href="{{ route('admin.users.create') }}" class="btn-add">+ Tambah Admin</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Dibuat Pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td style="font-weight: 600;">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">Edit</a>
                    
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection