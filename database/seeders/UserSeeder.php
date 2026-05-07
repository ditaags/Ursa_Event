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
            'id' => Str::upper(Str::random(20)),
            'name' => 'nano',
            'username' => 'nano1234',
            'email' => 'nano@gmail.com',
            'password' => User::customHash('nano1234'),
            'level' => 'user',
            'tanggal_lahir' => '2000-01-01',
        ]);

        User::create([
            'id' => Str::upper(Str::random(20)),
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => User::customHash('superadmin'),
            'level' => 'superadmin',
            'tanggal_lahir' => '2000-01-01',
        ]);

        User::create([
            'id' => Str::upper(Str::random(20)),
            'name' => 'Admin',
            'username' => 'admin123',
            'email' => 'admin@gmail.com',
            'password' => User::customHash('admin123'),
            'level' => 'admin',
            'tanggal_lahir' => '2000-01-01',
        ]);

        User::create([
            'id' => Str::upper(Str::random(20)),
            'name' => 'Finance',
            'username' => 'finance1',
            'email' => 'finance@gmail.com',
            'password' => User::customHash('finance1'),
            'level' => 'finance',
            'tanggal_lahir' => '2000-01-01',
        ]);

        User::create([
            'id' => Str::upper(Str::random(20)),
            'name' => 'Crew',
            'username' => 'crew1234',
            'email' => 'crew@gmail.com',
            'password' => User::customHash('crew1234'),
            'level' => 'crew',
            'tanggal_lahir' => '2000-01-01',
        ]);
    }
}