<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LockUserAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next The closure to call the next middleware
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->is_locked) {
            auth()->logout();
            abort(403, 'Your account has been locked.');
        }

        return $next($request);
    }
}
