<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->create(
                [
                    'name' => 'Admin',
                    'role' => 'admin',
                    'email' => 'admin@mm.com',
                ]
            );

        User::factory()
            ->makeEmail()
            ->unverified()
            ->count(5)
            ->create(
                [
                    'role' => 'customer',
                ]
            );
    }
}
