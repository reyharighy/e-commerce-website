<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_number' => 'INV-' . strtoupper(Str::random()),
            'shipping_address' => fake()->address(),
            'shipping_cost' => fake()->numberBetween(0, 100) * 1000,
            'status' => fake()->randomElement(Order::$orderStatus),
        ];
    }
}
