<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts'; // Nama tabel di Supabase
    protected $fillable = ['address', 'email', 'whatsapp', 'instagram', 'tiktok'];
}