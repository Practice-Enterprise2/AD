<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LockUserAccount
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();
    
        if ($user && $user->is_locked) {
            auth()->logout();
            abort(403, 'Your account has been locked.');
        }
    
        return $next($request);
    }
    
}