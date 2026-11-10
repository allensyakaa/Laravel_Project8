<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Akun contoh (password semuanya: password123). Ganti setelah dipakai sungguhan.
     */
    public function run(): void
    {
        $accounts = [
            ['Owner Toko', 'owner@example.com', User::ROLE_OWNER],
            ['Kasir Satu', 'kasir@example.com', User::ROLE_KASIR],
            ['Pelanggan Contoh', 'pelanggan@example.com', User::ROLE_PELANGGAN],
        ];

        foreach ($accounts as [$name, $email, $role]) {
            // forceFill karena 'role' sengaja tidak boleh diisi lewat form (mass assignment)
            User::firstOrNew(['email' => $email])
                ->forceFill(['name' => $name, 'password' => 'password123', 'role' => $role]) // password di-hash otomatis oleh cast
                ->save();
        }
    }
}
