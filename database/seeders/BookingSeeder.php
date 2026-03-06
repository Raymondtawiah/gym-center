<?php

namespace Database\Seeders;

use App\Models\ClassBooking;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'client')->get();
        
        if ($users->isEmpty()) {
            $this->command->info('No clients found. Please create clients first.');
            return;
        }
        
        $membershipTypes = ['monthly', 'yearly'];
        
        foreach ($users as $user) {
            // Create 1 membership per user
            $membershipType = $membershipTypes[array_rand($membershipTypes)];
            $startDate = now()->subDays(rand(0, 30));
            
            // Calculate end date based on membership type
            if ($membershipType === 'monthly') {
                $endDate = $startDate->copy()->addMonth();
            } else {
                $endDate = $startDate->copy()->addYear();
            }
            
            // Check if booking already exists
            $exists = ClassBooking::where('user_id', $user->id)
                ->where('membership_type', $membershipType)
                ->exists();
            
            if (!$exists) {
                ClassBooking::create([
                    'user_id' => $user->id,
                    'gym_class_id' => null, // No class - this is a membership
                    'booking_date' => $startDate,
                    'status' => 'confirmed',
                    'gym_id' => $user->gym_id,
                    // Membership fields
                    'membership_type' => $membershipType,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'notes' => 'Initial membership',
                ]);
            }
        }
        
        $this->command->info('Created memberships for ' . $users->count() . ' users.');
    }
}
