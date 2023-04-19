<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Log extends Component
{
    public string $log;

    public function mount(): void
    {
        if (file_exists(storage_path('logs/laravel.log'))) {
            $this->log = file_get_contents(storage_path('logs/laravel.log'));
        }
    }

    public function clear(): void
    {
        $file = fopen(storage_path('logs/laravel.log'), 'w');

        if (file_exists(storage_path('logs/laravel.log'))) {
            $this->log = file_get_contents(storage_path('logs/laravel.log'));
        }

        fclose($file);
    }

    public function update(): void
    {
        if (file_exists(storage_path('logs/laravel.log'))) {
            $this->log = file_get_contents(storage_path('logs/laravel.log'));
        }
    }
}
