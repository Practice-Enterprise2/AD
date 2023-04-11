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
        $this->format_php_code();
        $this->format_using_prettier();
        $this->format_blade_templates();
    }

    public function format_php_code(): void
    {
        $process = [config('development.laravel_pint_path')];
        if ($this->option('test')) {
            array_push($process, '--test');
        }
        $pint_process = new Process($process);
        $pint_process->setTty(true);
        $pint_process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }

    public function format_using_prettier(): void
    {
        $process = [config('development.prettier_path'), '.'];
        if ($this->option('test')) {
            array_push($process, '--check');
        } else {
            array_push($process, '--write');
        }
        $prettier_process = new Process($process);
        $prettier_process->setTty(true);
        $prettier_process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }

    public function format_blade_templates(): void
    {
        $process = [config('development.blade_formatter_path'), 'resources/**/*.blade.php'];
        if ($this->option('test')) {
            array_push($process, '--check-formatted');
        } else {
            array_push($process, '--write');
        }
        $blade_formatter_process = new Process($process);
        $blade_formatter_process->setTty(true);
        $blade_formatter_process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
}
