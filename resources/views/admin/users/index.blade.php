@extends('admin_master')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">

<div class="admin-container">

    <div class="admin-header">
        <h2 style="color: #e63946;">Daftar User Ursa</h2>

        <a href="{{ route('admin.users.create') }}" class="btn-add">
            + Tambah User
        </a>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <table class="admin-table">

        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($users as $user)

                <tr>

                    {{-- USERNAME --}}
                    <td class="username-cell">
                        {{ $user->username }}
                    </td>

                    {{-- EMAIL --}}
                    <td>
                        {{ $user->email }}
                    </td>

                    {{-- LEVEL --}}
                    <td>

                        @if($user->level == 'superadmin')

                            <span class="badge-superadmin">
                                Super Admin
                            </span>

                        @elseif($user->level == 'admin')

                            <span class="badge-admin">
                                Admin
                            </span>

                        @else

                            <span class="badge-finance">
                                Finance
                            </span>

                        @endif

                    </td>

                    {{-- AKSI --}}
                    <td class="action-buttons">

                        {{-- EDIT --}}
                        <button class="btn-edit"
                                onclick="openEditModal(
                                    '{{ $user->id }}',
                                    '{{ $user->username }}',
                                    '{{ $user->email }}',
                                    '{{ $user->level }}'
                                )">

                            Edit

                        </button>

                        {{-- DELETE --}}
                        <button class="btn-delete"
                                onclick="openDeleteModal(
                                    '{{ $user->id }}'
                                )">

                            Hapus

                        </button>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4" class="empty-data">
                        Belum ada data user.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal-overlay" id="editModal">

    <div class="modal-box">

        <div class="modal-header">
            <h3>Edit User</h3>

            <button class="modal-close"
                    onclick="closeEditModal()">

                ×

            </button>
        </div>

        <form method="POST" id="editForm">

            @csrf
            @method('PUT')

            {{-- USERNAME --}}
            <div class="input-group">
                <label>Username</label>

                <input type="text"
                       name="username"
                       id="editUsername"
                       required>
            </div>

            {{-- EMAIL --}}
            <div class="input-group">
                <label>Email</label>

                <input type="email"
                       name="email"
                       id="editEmail"
                       required>
            </div>

            {{-- PASSWORD --}}
            <div class="input-group">
                <label>Password Baru</label>

                <input type="password"
                       name="password"
                       placeholder="Kosongkan jika tidak ingin mengganti">
            </div>

            {{-- LEVEL --}}
            <div class="input-group">
                <label>Level</label>

                <select name="level"
                        id="editLevel"
                        required>

                    <option value="superadmin">
                        Super Admin
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                    <option value="finance">
                        Finance
                    </option>

                </select>
            </div>

            <div class="modal-actions">

                <button type="button"
                        class="btn-cancel-modal"
                        onclick="closeEditModal()">

                    Batal

                </button>

                <button type="submit"
                        class="btn-save-modal">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

{{-- ================= DELETE MODAL ================= --}}
<div class="modal-overlay" id="deleteModal">

    <div class="modal-delete-box">

        <div class="delete-icon">
            !
        </div>

        <h3>Hapus Data</h3>

        <p>
            Apakah anda yakin ingin menghapus data ini?
        </p>

        <div class="modal-actions">

            <button type="button"
                    class="btn-cancel-modal"
                    onclick="closeDeleteModal()">

                Tidak

            </button>

            <form method="POST" id="deleteForm">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn-delete-confirm">

                    Iya, Hapus

                </button>

            </form>

        </div>

    </div>

</div>

<script>

function openEditModal(id, username, email, level)
{
    document.getElementById('editModal').style.display = 'flex';

    document.getElementById('editUsername').value = username;

    document.getElementById('editEmail').value = email;

    document.getElementById('editLevel').value = level;

    document.getElementById('editForm').action =
        `/admin/users/${id}`;
}

function closeEditModal()
{
    document.getElementById('editModal').style.display = 'none';
}

/* ================= DELETE ================= */

function openDeleteModal(id)
{
    document.getElementById('deleteModal').style.display = 'flex';

    document.getElementById('deleteForm').action =
        `/admin/users/${id}`;
}

function closeDeleteModal()
{
    document.getElementById('deleteModal').style.display = 'none';
}

</script>

@endsection