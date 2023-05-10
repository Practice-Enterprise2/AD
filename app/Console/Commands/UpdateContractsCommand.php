<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class UpdateContractsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contracts:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updata contracts that have run out by setting them to inactive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        DB::table('contacts')
            ->where('end_date',$today)
            ->update(['active' => false]);
    }
}
