@extends('admin_master')

@section('content')
<div class="welcome-card">
    <h2 style="color: #e63946; margin-bottom: 10px;">Edit Kontak & Sosial Media</h2>
    <p>Perbarui informasi alamat, email, dan media sosial Ursa Event.</p>

    @if(session('success'))
        <div style="padding: 15px; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.update_kontak') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
            
            <div style="grid-column: span 2;">
                <label style="display:block; margin-bottom:8px; font-weight:600;">Alamat Kantor</label>
                <textarea name="address" rows="3" style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">{{ old('address', $contact->address) }}</textarea>
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">Email Resmi</label>
                <input type="email" name="email" value="{{ old('email', $contact->email) }}" style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">WhatsApp (Contoh: 62812...)</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp) }}" style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">Username Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', $contact->instagram) }}" placeholder="@ursaevent" style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:block; margin-bottom:8px; font-weight:600;">Username TikTok</label>
                <input type="text" name="tiktok" value="{{ old('tiktok', $contact->tiktok) }}" placeholder="@ursaevent_official" style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
            </div>
        </div>

        <button type="submit" style="margin-top:25px; background:#e63946; color:white; border:none; padding:12px 30px; border-radius:10px; font-weight:600; cursor:pointer;">
            Simpan Perubahan Kontak
        </button>
    </form>
</div>
@endsection