<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $oneMonthFromNow = Carbon::today()->addMonth();
        $contracts = DB::table('contracts')
            ->whereBetween('enddate', [$today, $oneMonthFromNow])
            ->where('is_active', 1)
            ->get();

        foreach ($contracts as $contract) {
            // Get the manager email
            $managerEmail = DB::table('employees')
                ->where('jobTitle', 'Manager')
                ->value('email');

            // Send email notification to manager
            Mail::send('contract_expiry', ['contractId' => $contract->id], function ($message) use ($managerEmail) {
                $message->to($managerEmail)
                    ->subject('Contract Expiry Notification');
            });
            DB::table('contracts')
                ->where('end_date', $today)
                ->update(['is_active' => 0]);
        }
    }
}
