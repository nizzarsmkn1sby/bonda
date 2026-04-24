<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::where('name', 'owner')->first();
        $cashierRole = Role::where('name', 'cashier')->first();

        // Create Owner
        User::create([
            'name' => 'Owner',
            'email' => 'owner@cashier.com',
            'password' => Hash::make('password'),
            'role_id' => $ownerRole->id,
            'is_active' => true,
        ]);

        // Create Cashier
        User::create([
            'name' => 'Kasir 1',
            'email' => 'cashier@cashier.com',
            'password' => Hash::make('password'),
            'role_id' => $cashierRole->id,
            'is_active' => true,
        ]);
    }
}
