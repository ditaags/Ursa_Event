<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event'; // Sesuaikan jika nama tabelnya 'event' (tanpa s)

    protected $fillable = [
        'nama_event',
        'tanggal',
        'deskripsi',
        'jam',
        'status',
    ];
}