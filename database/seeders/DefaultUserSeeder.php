<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gymcenter.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_approved' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Default admin user seeded: admin@gymcenter.com / admin123');
    }
}
