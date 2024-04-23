<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            // inRandomOrder to get a random customer ID
            'customer_id' => Customer::inRandomOrder()->first()->id,
            // randomElement geta random choice of choosing
            'product_name' => fake()->randomElement(['DERV', 'IHO', 'Kerosene', 'Gas Oil', 'AdBlue']),
            // numberBetween to get a random number
            'quantity' => fake()->numberBetween(500, 20000)
        ];
    }
}
