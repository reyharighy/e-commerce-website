<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

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
