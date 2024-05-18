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
        $products = fake()->randomElement(['DERV', 'IHO', 'Kerosene', 'Gas Oil', 'AdBlue']);
        $quantity = fake()->numberBetween(500, 20000);

        // Pricing rules
        $pricing = [
            'DERV' => ['threshold' => 10000, 'low' => 1.10, 'high' => 1.05],
            'IHO' => ['threshold' => 10000, 'low' => 0.70, 'high' => 0.65],
            'Kerosene' => ['threshold' => 10000, 'low' => 0.68, 'high' => 0.63],
            'Gas Oil' => ['threshold' => 10000, 'low' => 0.85, 'high' => 0.80],
            'AdBlue' => ['threshold' => 10000, 'low' => 0.30, 'high' => 0.25]
        ];

        if (isset($pricing[$products])) {
            $ppl = $quantity < $pricing[$products]['threshold'] ?
                   $pricing[$products]['low'] :
                   $pricing[$products]['high'];
        }

        $pplSellAt = fake()->randomFloat(2, 0.01, 0.2) + $ppl;
        $nettCost = $quantity * $pplSellAt;
        $vat = $nettCost / 100 * 20;
        $totalCost = $nettCost + $vat;
        $pplProfit = $pplSellAt - $ppl;
        $profit = ($pplSellAt - $ppl) * $quantity;


        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'product_name' => $products,
            'quantity' => $quantity,
            // number_format to get 2 decimal places
            'ppl' => number_format($ppl, 2, '.', ''),
            'ppl_sell_at' => number_format($pplSellAt, 2, '.', ''),
            'ppl_profit' => number_format($pplProfit, 2, '.', ''),
            'nett_cost' => number_format($nettCost, 2, '.', ''),
            'vat' => number_format($vat, 2, '.', ''),
            'total_cost' => number_format($totalCost, 2, '.', ''),
            'profit' => number_format($profit, 2, '.', ''),
        ];
    }
}
