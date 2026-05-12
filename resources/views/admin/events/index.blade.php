@extends('admin_master')

@section('content')

<div class="welcome-card">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">

        <h2 style="color: #e63946;">
            Daftar Event Ursa
        </h2>

        <a href="{{ route('admin.events.create') }}"
           style="background: #e63946; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;">
            + Tambah Event
        </a>

    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">

        <thead>
            <tr style="background: #f8fafc; text-align: left; border-bottom: 2px solid #eee;">
                <th style="padding: 15px;">Poster</th>
                <th style="padding: 15px;">Nama Event</th>
                <th style="padding: 15px;">Tanggal</th>
                <th style="padding: 15px;">Jam</th>
                <th style="padding: 15px;">Status</th>
                <th style="padding: 15px;">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($events as $event)

            <tr style="border-bottom: 1px solid #eee;">

                <td style="padding: 15px;">
                    @if($event->foto)
                        <img
                            src="{{ $event->foto }}"
                            width="60"
                            height="60"
                            style="border-radius: 5px; object-fit: cover;"
                        >
                    @else
                        <span>Tidak Ada</span>
                    @endif
                </td>

                <td style="padding: 15px; font-weight: 600;">
                    {{ $event->nama_event }}
                </td>

                <td style="padding: 15px;">
                    {{ $event->tanggal }}
                </td>

                <td style="padding: 15px;">
                    {{ $event->jam }}
                </td>

                <td style="padding: 15px;">
                    {{ ucfirst($event->status) }}
                </td>

                <td style="padding: 15px;">

                    <button
                        onclick="openModal('modal{{ $event->id_event }}')"
                        style="background: #334155; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                        Edit
                    </button>
                    
                </td>

            </tr>

            <!-- Modal Edit -->
            <div id="modal{{ $event->id_event }}"
                 style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; overflow:auto;">

                <div style="background:white; width:90%; max-width:700px; margin:50px auto; padding:30px; border-radius:12px; position:relative;">

                    <button
                        onclick="closeModal('modal{{ $event->id_event }}')"
                        style="position:absolute; top:15px; right:15px; background:none; border:none; font-size:22px; cursor:pointer;">
                        ×
                    </button>

                    <h2 style="margin-bottom:20px; color:#e63946;">
                        Edit Event
                    </h2>

                    <form action="{{ route('admin.events.update', $event->id_event) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div style="margin-bottom:15px;">
                            <label>Nama Event</label>
                            <input
                                type="text"
                                name="nama_event"
                                value="{{ $event->nama_event }}"
                                required
                                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
                        </div>

                        <div style="display:flex; gap:15px; margin-bottom:15px;">

                            <div style="width:100%;">
                                <label>Tanggal</label>
                                <input
                                    type="date"
                                    name="tanggal"
                                    value="{{ $event->tanggal }}"
                                    required
                                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
                            </div>

                            <div style="width:100%;">
                                <label>Jam</label>
                                <input
                                    type="time"
                                    name="jam"
                                    value="{{ $event->jam }}"
                                    required
                                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">
                            </div>

                        </div>

                        {{-- STATUS KHUSUS SUPERADMIN --}}
                        @if(auth()->user()->level == 'superadmin')

                        <div style="margin-bottom:15px;">
                            <label>Status</label>

                            <select
                                name="status"
                                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">

                                <option value="pending"
                                    {{ $event->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="aktif"
                                    {{ $event->status == 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="nonaktif"
                                    {{ $event->status == 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>

                            </select>
                        </div>

                        @else

                        <input
                            type="hidden"
                            name="status"
                            value="{{ $event->status }}">

                        @endif

                        <div style="margin-bottom:15px;">
                            <label>Deskripsi</label>

                            <textarea
                                name="deskripsi"
                                rows="5"
                                required
                                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:8px;">{{ $event->deskripsi }}</textarea>
                        </div>

                        <div style="margin-bottom:20px;">

                            <label>Poster Event</label>

                            <br><br>

                            @if($event->foto)
                                <img
                                    src="{{ $event->foto }}"
                                    width="120"
                                    style="border-radius:10px; margin-bottom:10px;">
                            @endif

                            <input
                                type="file"
                                name="foto"
                                accept="image/*"
                                style="display:block;">
                        </div>

                        <div style="display:flex; justify-content:flex-end; gap:10px;">

                            <button
                                type="button"
                                onclick="closeModal('modal{{ $event->id_event }}')"
                                style="padding:10px 20px; border:none; border-radius:8px; background:#cbd5e1; cursor:pointer;">
                                Batal
                            </button>

                            <button
                                type="submit"
                                style="padding:10px 20px; border:none; border-radius:8px; background:#e63946; color:white; cursor:pointer;">
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

            @empty

            <tr>
                <td colspan="6" style="padding: 20px; text-align: center;">
                    Belum ada data event
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'block';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>

@endsection