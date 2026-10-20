<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\User;

class HomeController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = storage_path('app/content/');
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // Menghitung seluruh event
        $totalEvent = Event::count();

        // Menghitung event dengan status aktif
        $eventAktif = Event::where('status', 'aktif')->count();

        // Menghitung seluruh pengguna dari semua level
        $totalPengguna = User::count();

        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK PENDAPATAN TIKET
        |--------------------------------------------------------------------------
        */

        $chart = DB::table('transaksis')
            ->join(
                'tikets',
                'transaksis.id_tiket',
                '=',
                'tikets.id'
            )
            ->whereIn('transaksis.status', [
                'aktif',
                'expired'
            ])
            ->select(
                'tikets.nama_tiket',
                DB::raw(
                    'SUM(transaksis.sub_total) as total_pendapatan'
                )
            )
            ->groupBy('tikets.nama_tiket')
            ->get();

        // Label dan nilai grafik
        $chartLabels = $chart->pluck('nama_tiket');
        $chartData = $chart->pluck('total_pendapatan');

        return view('admin.dashboard', compact(
            'totalEvent',
            'eventAktif',
            'totalPengguna',
            'chartLabels',
            'chartData'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | BERANDA
    |--------------------------------------------------------------------------
    */

    public function edit()
    {
        $content = (object)[
            'title' => $this->readFile('title.txt'),
            'terms' => $this->readFile('terms.txt'),
            'rules' => $this->readFile('rules.txt'),
        ];

        return view('admin.edit_beranda', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN FILE TXT
        |--------------------------------------------------------------------------
        */

        file_put_contents(
            $this->path . 'title.txt',
            $request->title
        );

        file_put_contents(
            $this->path . 'terms.txt',
            $request->terms
        );

        file_put_contents(
            $this->path . 'rules.txt',
            $request->rules
        );

        /*
        |--------------------------------------------------------------------------
        | UPLOAD HERO IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            // Lokasi folder
            $destination = public_path('images');

            // Nama file tetap
            $filename = 'gedung.png';

            // Path file lama
            $oldFile = $destination . '/' . $filename;

            // Hapus file lama jika ada
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }

            // Simpan file baru dengan nama tetap
            $file->move($destination, $filename);
        }

        return redirect()
            ->back()
            ->with('success', 'Konten berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | KONTAK
    |--------------------------------------------------------------------------
    */

    public function editContact()
    {
        $contact = (object)[
            'alamat' => $this->readFile('alamat.txt'),
            'linkalamat' => $this->readFile('linkalamat.txt'),

            'wa' => $this->readFile('wa.txt'),
            'linkwa' => $this->readFile('linkwa.txt'),

            'email' => $this->readFile('email.txt'),
            'linkemail' => $this->readFile('linkemail.txt'),

            'ig' => $this->readFile('ig.txt'),
            'linkig' => $this->readFile('linkig.txt'),

            'tt' => $this->readFile('tt.txt'),
            'linktt' => $this->readFile('linktt.txt'),
        ];

        return view('admin.edit_kontak', compact('contact'));
    }

    public function updateContact(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | SIMPAN KONTAK
        |--------------------------------------------------------------------------
        */

        file_put_contents(
            $this->path . 'alamat.txt',
            $request->alamat
        );

        file_put_contents(
            $this->path . 'linkalamat.txt',
            $request->linkalamat
        );

        file_put_contents(
            $this->path . 'wa.txt',
            $request->wa
        );

        file_put_contents(
            $this->path . 'linkwa.txt',
            $request->linkwa
        );

        file_put_contents(
            $this->path . 'email.txt',
            $request->email
        );

        file_put_contents(
            $this->path . 'linkemail.txt',
            $request->linkemail
        );

        file_put_contents(
            $this->path . 'ig.txt',
            $request->ig
        );

        file_put_contents(
            $this->path . 'linkig.txt',
            $request->linkig
        );

        file_put_contents(
            $this->path . 'tt.txt',
            $request->tt
        );

        file_put_contents(
            $this->path . 'linktt.txt',
            $request->linktt
        );

        return redirect()
            ->back()
            ->with('success', 'Kontak berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | READ FILE
    |--------------------------------------------------------------------------
    */

    private function readFile($file)
    {
        $fullPath = $this->path . $file;

        if (!file_exists($fullPath)) {
            file_put_contents($fullPath, '');
        }

        return file_get_contents($fullPath);
    }
}