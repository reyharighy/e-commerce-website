<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        if ($orders->isEmpty())
        {
            $this->command->info('No orders found, skipping payment seeding.');
            return;
        }

        foreach ($orders as $order)
        {
            $price = $order->orderDetails->sum(
                function ($orderDetail)
                {
                    return $orderDetail->price;
                }
            );

            Payment::factory()
                ->create(
                    [
                        'order_id' => $order->id,
                        'amount' => $price,
                    ]
                );
        }
    }
}
