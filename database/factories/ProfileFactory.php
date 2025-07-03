<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->streetAddress(),
        ];
    }

    protected static function indonesianPhoneNumberType(): string {
        $number = '08';

        for ($i = 0; $i < 10; $i++) {
            $number .= fake()->numberBetween(0, 9);
        }

        return $number;
    }

    public function makePhoneNumber(): static {
        return $this->state(fn () => [
            'phone_number' => $this->indonesianPhoneNumberType()
        ]);
    }
}
