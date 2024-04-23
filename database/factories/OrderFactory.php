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
        $productName = fake()->randomElement(['DERV', 'IHO', 'Kerosene', 'Gas Oil', 'AdBlue']);
        $quantity = fake()->numberBetween(500, 20000);

        if ($productName === 'DERV' && $quantity < 10000) {
            $ppl = 1.10;
        } elseif ($productName === 'DERV' && $quantity >= 10000) {
            $ppl = 1.05;
        } elseif ($productName === 'IHO' && $quantity < 10000) {
            $ppl = .70;
        } elseif ($productName === 'IHO' && $quantity >= 10000) {
            $ppl = .65;
        } elseif ($productName === 'Kerosene' && $quantity < 10000) {
            $ppl = .68;
        } elseif ($productName === 'Kerosene' && $quantity >= 10000) {
            $ppl = .63;
        } elseif ($productName === 'Gas Oil' && $quantity < 10000) {
            $ppl = .85;
        } elseif ($productName === 'Gas Oil' && $quantity >= 10000) {
            $ppl = .80;
        } elseif ($productName === 'AdBlue' && $quantity < 10000) {
            $ppl = .30;
        } elseif ($productName === 'AdBlue' && $quantity >= 10000) {
            $ppl = .25;
        }

        return [
            // inRandomOrder to get a random customer ID
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'product_name' => $productName,
            'quantity' => $quantity,
            'ppl' => $ppl,
            'total_cost' => $quantity * $ppl
        ];
    }
}
