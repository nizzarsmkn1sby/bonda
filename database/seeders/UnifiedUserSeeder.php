<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UnifiedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Menggabungkan semua role ke dalam satu database
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Hapus semua user existing
        User::truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Create Owner
        User::create([
            'name' => 'Owner Nusa',
            'email' => 'owner@nusastore.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'email_verified_at' => now(),
        ]);
        
        // Create Cashier 1
        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir1@nusastore.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'email_verified_at' => now(),
        ]);
        
        // Create Cashier 2
        User::create([
            'name' => 'Kasir 2',
            'email' => 'kasir2@nusastore.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'email_verified_at' => now(),
        ]);
        
        // Create Restoker 1
        User::create([
            'name' => 'Restoker 1',
            'email' => 'restoker1@nusastore.com',
            'password' => Hash::make('password'),
            'role' => 'restoker',
            'email_verified_at' => now(),
        ]);
        
        // Create Restoker 2
        User::create([
            'name' => 'Restoker 2',
            'email' => 'restoker2@nusastore.com',
            'password' => Hash::make('password'),
            'role' => 'restoker',
            'email_verified_at' => now(),
        ]);
        
        // Create Regular User 1
        User::create([
            'name' => 'Customer 1',
            'email' => 'customer1@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
        
        // Create Regular User 2
        User::create([
            'name' => 'Customer 2',
            'email' => 'customer2@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('✅ Unified users created successfully!');
        $this->command->info('');
        $this->command->info('📋 Login Credentials (All in ONE database):');
        $this->command->info('');
        $this->command->info('👑 OWNER:');
        $this->command->info('   Email: owner@nusastore.com');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('💰 CASHIER 1:');
        $this->command->info('   Email: kasir1@nusastore.com');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('💰 CASHIER 2:');
        $this->command->info('   Email: kasir2@nusastore.com');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('📦 RESTOKER 1:');
        $this->command->info('   Email: restoker1@nusastore.com');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('📦 RESTOKER 2:');
        $this->command->info('   Email: restoker2@nusastore.com');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('👤 CUSTOMER 1:');
        $this->command->info('   Email: customer1@example.com');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('👤 CUSTOMER 2:');
        $this->command->info('   Email: customer2@example.com');
        $this->command->info('   Password: password');
    }
}
