<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function index()
    {
        $events = DB::table('event')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.event', compact('events'));
    }

    public function publicEvent()
    {
        $events = DB::table('event')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('event', compact('events'));
    }

    public function create()
    {
        return view('admin.tambahevent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $path = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('event'), $namaFile);
            $path = 'event/' . $namaFile;
        }

        DB::table('event')->insert([
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'foto' => $path,
            'deskripsi' => $request->deskripsi,
            'jam' => $request->jam,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Event berhasil ditambahkan');
    }

    // --- FUNGSI BARU: EDIT EVENT ---
    public function edit($id)
    {
        $event = DB::table('event')->where('id_event', $id)->first();

        if (!$event) {
            return redirect()->route('admin.event')->with('error', 'Event tidak ditemukan');
        }

        return view('admin.editevent', compact('event'));
    }

    // --- FUNGSI BARU: UPDATE EVENT ---
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_event' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $event = DB::table('event')->where('id_event', $id)->first();
        $path = $event->foto;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($path && File::exists(public_path($path))) {
                File::delete(public_path($path));
            }

            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('event'), $namaFile);
            $path = 'event/' . $namaFile;
        }

        DB::table('event')->where('id_event', $id)->update([
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'foto' => $path,
            'deskripsi' => $request->deskripsi,
            'jam' => $request->jam,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.event')->with('success', 'Event berhasil diperbarui');
    }

    // --- FUNGSI BARU: HAPUS EVENT ---
    public function destroy($id)
    {
        $event = DB::table('event')->where('id_event', $id)->first();

        if ($event) {
            // Hapus file foto dari folder public
            if ($event->foto && File::exists(public_path($event->foto))) {
                File::delete(public_path($event->foto));
            }

            DB::table('event')->where('id_event', $id)->delete();
            return redirect()->route('admin.event')->with('success', 'Event berhasil dihapus');
        }

        return redirect()->route('admin.event')->with('error', 'Gagal menghapus event');
    }
}