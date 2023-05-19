<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (\Throwable $e) {
        });
    }

    /**
     * Report the exception.
     *
     *
     * @return void
     */
    public function report(\Throwable $exception)
    {
        // Log all exceptions to the custom_txt_log channel
        $logData = [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ];

        if (config('app.debug')) {
            $logData['trace'] = $exception->getTraceAsString();
        }

        Log::channel('custom_txt_log')->error($exception->getMessage(), $logData);
    }
}
