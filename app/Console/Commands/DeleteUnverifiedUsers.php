<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-unverified-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $unverifiedUsers = User::whereNull('email_verified_at')
            ->where('created_at', '<=', now()->subDays(2))
            ->get();

        foreach ($unverifiedUsers as $user) {
            $user->delete();
        }
    }
}
