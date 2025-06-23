<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        if ($orders->isEmpty() || $products->isEmpty())
        {
            $this->command->info('Neither orders nor products found, skipping order details seeding.');
            return;
        }

        foreach ($orders as $order)
        {
            $detailCount = rand(1, 5);
            $shuffledProducts = $products->shuffle()->take($detailCount);

            foreach ($shuffledProducts as $product)
            {
                $quantity = rand(1, 5);

                OrderDetail::factory()
                    ->create(
                        [
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'quantity' => $quantity,
                            'price' => $product->price * $quantity,
                        ]
                    );
            }
        }
    }
}
