<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

/**
 * @api
 */
class Clippy extends Command
{
    protected $signature = 'clippy';

    protected $description = 'Run static analysis';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $process = ['php', config('development.psalm_path')];
        $psalm_process = new Process($process);
        $psalm_process->run(function (string $_type, string $buffer) {
            echo $buffer;
        });

        if (! $psalm_process->isSuccessful()) {
            exit(1);
        }
    }
}
