<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = storage_path('app/content/');
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
        | Simpan File TXT
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
        | Upload Hero Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

    $file = $request->file('image');

    // lokasi folder
    $destination = public_path('images');

    // nama file tetap
    $filename = 'gedung.png';

    // path file lama
    $oldFile = $destination . '/' . $filename;

    // hapus file lama jika ada
    if (file_exists($oldFile)) {
        unlink($oldFile);
    }

    // simpan file baru dengan nama tetap
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