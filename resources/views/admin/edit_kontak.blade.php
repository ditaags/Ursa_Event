@extends('admin_master')

@section('content')

<div class="welcome-card">

    <h2 style="color:#e63946; margin-bottom:10px;">
        Edit Kontak & Sosial Media
    </h2>

    <p>Perbarui informasi kontak dan sosial media.</p>

    @if(session('success'))
        <div style="padding:15px; background:#d4edda; color:#155724; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.update_kontak') }}" method="POST">
        @csrf

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:20px;">

            <!-- ALAMAT -->
            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Deskripsi Alamat
                </label>

                <textarea name="alamat" rows="4"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">{{ old('alamat', $contact->alamat) }}</textarea>
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Link Google Maps
                </label>

                <input type="text"
                    name="linkalamat"
                    value="{{ old('linkalamat', $contact->linkalamat) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <!-- WHATSAPP -->
            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Nomor WhatsApp
                </label>

                <input type="text"
                    name="wa"
                    value="{{ old('wa', $contact->wa) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Link WhatsApp
                </label>

                <input type="text"
                    name="linkwa"
                    value="{{ old('linkwa', $contact->linkwa) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <!-- EMAIL -->
            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Email
                </label>

                <input type="text"
                    name="email"
                    value="{{ old('email', $contact->email) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Link Email
                </label>

                <input type="text"
                    name="linkemail"
                    value="{{ old('linkemail', $contact->linkemail) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <!-- INSTAGRAM -->
            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Instagram
                </label>

                <input type="text"
                    name="ig"
                    value="{{ old('ig', $contact->ig) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Link Instagram
                </label>

                <input type="text"
                    name="linkig"
                    value="{{ old('linkig', $contact->linkig) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <!-- TIKTOK -->
            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    TikTok
                </label>

                <input type="text"
                    name="tt"
                    value="{{ old('tt', $contact->tt) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">
                    Link TikTok
                </label>

                <input type="text"
                    name="linktt"
                    value="{{ old('linktt', $contact->linktt) }}"
                    style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

        </div>

        <button type="submit"
            style="margin-top:25px; background:#e63946; color:white; border:none; padding:12px 30px; border-radius:10px; font-weight:600; cursor:pointer;">
            Simpan Kontak
        </button>

    </form>

</div>

@endsection