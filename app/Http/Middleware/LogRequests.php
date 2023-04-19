<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    public string $description = 'Log every request.';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next Give the request to the next middleware
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info($request->url().' accessed.');

        return $next($request);
    }
}
