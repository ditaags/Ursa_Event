<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\Contact; // <-- PINDAH KE SINI (Paling Atas)
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /* --- Fitur Edit Beranda --- */
    
    public function edit()
    {
        $content = HomeContent::first();
        return view('admin.edit_beranda', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rules' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $content = HomeContent::first();
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'rules' => $request->rules,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/home', $nama_file);
            $data['image'] = $nama_file;
        }

        $content->update($data);
        return redirect()->back()->with('success', 'Beranda berhasil diperbarui!');
    }

    /* --- Fitur Edit Kontak (HARUS DI DALAM CLASS INI) --- */

    public function editContact()
    {
        $contact = Contact::first();
        return view('admin.edit_kontak', compact('contact'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'email' => 'required|email',
            'whatsapp' => 'required',
        ]);

        $contact = Contact::first();
        
        // Mengupdate address, email, whatsapp, instagram, tiktok sekaligus
        $contact->update($request->all());

        return redirect()->back()->with('success', 'Kontak berhasil diperbarui!');
    }
} 