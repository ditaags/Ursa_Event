<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $primaryKey = 'id_event';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_event',
        'nama_event',
        'tanggal',
        'foto',
        'deskripsi',
        'jam',
        'status',
    ];
}