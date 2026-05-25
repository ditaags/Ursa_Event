<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'jam'        => 'required',
            'deskripsi'  => 'required',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        do {
            $id = rand(100000, 999999);
        } while (Event::where('id_event', $id)->exists());

        $fotoUrl = null;

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $extension = $file->getClientOriginalExtension();

            $fileName = time() . '_' . uniqid() . '.' . $extension;

            $response = Http::withHeaders([
                'apikey' => env('SUPABASE_KEY'),
                'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
                'Content-Type' => $file->getMimeType(),
            ])->withBody(
                file_get_contents($file->getRealPath()),
                $file->getMimeType()
            )->put(
                env('SUPABASE_URL') . '/storage/v1/object/event-images/' . $fileName
            );

            if ($response->successful()) {

                $fotoUrl =
                    env('SUPABASE_URL') .
                    '/storage/v1/object/public/event-images/' .
                    $fileName;
            }
        }

        Event::create([
            'id_event'   => $id,
            'nama_event' => $request->nama_event,
            'tanggal'    => $request->tanggal,
            'foto'       => $fotoUrl,
            'deskripsi'  => $request->deskripsi,
            'jam'        => $request->jam,
            'status'     => 'pending',
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'jam'        => 'required',
            'deskripsi'  => 'required',
            'status'     => 'required',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoUrl = $event->foto;

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $extension = $file->getClientOriginalExtension();

            $fileName = time() . '_' . uniqid() . '.' . $extension;

            $response = Http::withHeaders([
                'apikey' => env('SUPABASE_KEY'),
                'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
                'Content-Type' => $file->getMimeType(),
            ])->withBody(
                file_get_contents($file->getRealPath()),
                $file->getMimeType()
            )->put(
                env('SUPABASE_URL') . '/storage/v1/object/event-images/' . $fileName
            );

            if ($response->successful()) {

                $fotoUrl =
                    env('SUPABASE_URL') .
                    '/storage/v1/object/public/event-images/' .
                    $fileName;
            }
        }

        $event->update([
            'nama_event' => $request->nama_event,
            'tanggal'    => $request->tanggal,
            'foto'       => $fotoUrl,
            'deskripsi'  => $request->deskripsi,
            'jam'        => $request->jam,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil diupdate');
    }
}