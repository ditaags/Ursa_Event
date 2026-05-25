<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
       
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => User::customHash('superadmin'),
            'level' => 'superadmin',
            'tanggal_lahir' => '2000-01-01',
        ]);
    }
}