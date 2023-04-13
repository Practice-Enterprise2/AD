<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogUserActivity
{
    public function handle($request, Closure $next)
    {
        $userId = Auth::id();
        $sessionId = session()->getId();
        $path = $request->getPathInfo();

        DB::table('logs')->insert([
            'user_id' => $userId,
            'session_id' => $sessionId,
            'path' => $path,
            'date' => now(),
        ]);

        return $next($request);
    }
}
