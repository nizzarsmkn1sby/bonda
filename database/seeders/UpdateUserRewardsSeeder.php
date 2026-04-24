<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UpdateUserRewardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users with role 'user'
        $userRole = Role::where('name', 'user')->first();
        
        if ($userRole) {
            $users = User::where('role_id', $userRole->id)->get();
            
            foreach ($users as $user) {
                // Calculate total spent from completed transactions
                $totalSpent = $user->transactions()
                    ->where('payment_status', 'completed')
                    ->sum('total');
                
                // Calculate reward points (1 point per 1000 spent)
                $rewardPoints = floor($totalSpent / 1000);
                
                // Update user
                $user->update([
                    'total_spent' => $totalSpent,
                    'reward_points' => $rewardPoints,
                ]);
                
                $this->command->info("Updated {$user->name}: Rp {$totalSpent} spent, {$rewardPoints} points");
            }
        }
        
        $this->command->info('User rewards updated successfully!');
    }
}
