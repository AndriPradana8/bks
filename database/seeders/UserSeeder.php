<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'nama' => 'Super Administrator',
            'username' => 'superadmin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'superadmin',
        ]);

        \App\Models\User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
