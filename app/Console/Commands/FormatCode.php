<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class FormatCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'format {--test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically format all of the project\'s PHP code';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $process = ['./vendor/bin/pint'];
        if ($this->option('test')) {
            array_push($process, '--test');
        }
        $pint_process = new Process($process);
        $pint_process->setTty(true);
        $pint_process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
}
