<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) 
        {
            $this->command->info('No users found, skipping order seeding.');
            return;
        }

        Order::factory()
            ->count(100)
            ->make()
            ->each(function ($order) use ($users)
            {
                $order->user_id = $users->random()->id;
                $order->save();
            });
    }
}
