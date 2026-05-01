<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@masjidagung.com',
            'password' => Hash::make('admin1'),
            'gender' => 'L',
            'role' => 'admin',
        ]);
    }
}
