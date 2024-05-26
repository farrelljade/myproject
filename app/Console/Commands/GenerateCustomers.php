<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;

class GenerateCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dummy customers for testing purposes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Customer::factory(10)->create();
        $this->info("Successfully created dummy customers.");
    }
}
