<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class GenerateOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dummy orders for testing purposes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Order::factory(10)->create();
        $this->info("Successfully created dummy orders.");
    }
}