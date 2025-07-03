<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) 
        {
            $this->command->info('No users found, skipping profile seeding.');
            return;
        }

        foreach ($users as $user) {
            if ($user->role === 'customer') {
                Profile::factory()
                    ->makePhoneNumber()
                    ->create([
                        'user_id' => $user->id
                    ]);
            }
        }
    }
}
