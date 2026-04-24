<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'owner',
                'description' => 'Pemilik toko dengan akses penuh ke semua fitur termasuk laporan dan manajemen pengguna',
            ],
            [
                'name' => 'cashier',
                'description' => 'Kasir dengan akses ke POS system dan riwayat transaksi',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
