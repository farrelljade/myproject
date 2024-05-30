<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dummy users for testing purposes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::factory(5)->create();
        $this->info("Successfully created 5 dummy users.");
    }
}
