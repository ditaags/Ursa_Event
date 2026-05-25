<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Pastikan schema dan nama tabel benar
    protected $table = 'ursaevent.users';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'password',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    // =========================
    // CUSTOM HASH
    // =========================
    public static function customHash($password)
    {
        $result = '';

        foreach (str_split($password) as $char) {

            if (ctype_upper($char)) {

                $result .= chr(ord($char) + 7);

            } elseif (ctype_lower($char)) {

                $result .= chr(ord($char) + 5);

            } elseif (ctype_digit($char)) {

                $result .= chr(ord($char) + 3);

            } else {

                $result .= $char;
            }
        }

        return $result;
    }
}