<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'nama' => 'Budi Santoso',
            'username' => '1234567890123456',
            'password' => \Illuminate\Support\Facades\Hash::make('23012003'), // DDMMYYYY of 2003-01-23
            'role' => 'nasabah',
        ]);

        \App\Models\Nasabah::create([
            'user_id' => $user->id,
            'nik' => '1234567890123456',
            'nama_lengkap' => 'Budi Santoso',
            'tanggal_lahir' => '2003-01-23',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Dummy Alamat No. 123',
        ]);
    }
}
