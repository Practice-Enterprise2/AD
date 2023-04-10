<?php

namespace App\Console\Commands;

use App\Providers\AppServiceProvider;
use Illuminate\Console\Command;

class Bootstrap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bootstrap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bootstrap the application during deployment';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        AppServiceProvider::bootstrap_database();
    }
}
