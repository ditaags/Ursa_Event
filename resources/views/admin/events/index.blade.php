@extends('admin_master')

@section('content')
<div class="welcome-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #e63946;">Daftar Event Ursa</h2>
        <a href="#" style="background: #e63946; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;">+ Tambah Event</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr style="background: #f8fafc; text-align: left; border-bottom: 2px solid #eee;">
                <th style="padding: 15px;">Poster</th>
                <th style="padding: 15px;">Nama Event</th>
                <th style="padding: 15px;">Tanggal</th>
                <th style="padding: 15px;">Lokasi</th>
                <th style="padding: 15px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 15px;">
                    <img src="{{ asset('storage/events/' . $event->image) }}" width="60" style="border-radius: 5px;">
                </td>
                <td style="padding: 15px; font-weight: 600;">{{ $event->title }}</td>
                <td style="padding: 15px;">{{ $event->date }}</td>
                <td style="padding: 15px;">{{ $event->location }}</td>
                <td style="padding: 15px;">
                    <button style="background: #334155; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Edit</button>
                    <button style="background: #e63946; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection