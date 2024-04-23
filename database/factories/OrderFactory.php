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

        // Pricing rules
        $pricing = [
            'DERV' => ['threshold' => 10000, 'low' => 1.10, 'high' => 1.05],
            'IHO' => ['threshold' => 10000, 'low' => 0.70, 'high' => 0.65],
            'Kerosene' => ['threshold' => 10000, 'low' => 0.68, 'high' => 0.63],
            'Gas Oil' => ['threshold' => 10000, 'low' => 0.85, 'high' => 0.80],
            'AdBlue' => ['threshold' => 10000, 'low' => 0.30, 'high' => 0.25]
        ];

        if (isset($pricing[$productName])) {
            $ppl = $quantity < $pricing[$productName]['threshold'] ?
                   $pricing[$productName]['low'] :
                   $pricing[$productName]['high'];
        }

        $totalCost = $quantity * $ppl;

        return [
            // inRandomOrder to get a random customer ID
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'product_name' => $productName,
            'quantity' => $quantity,
            // number_format to get 2 decimal places
            'ppl' => number_format($ppl, 2, '.', ''),
            'total_cost' => number_format($totalCost, 2, '.', '')
        ];
    }
}
