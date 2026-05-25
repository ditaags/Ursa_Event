<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    // Nama tabel di Supabase kamu
    protected $table = 'home_contents';

    // Daftar kolom yang boleh diisi
    protected $fillable = ['title', 'description', 'rules', 'image'];
}