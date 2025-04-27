<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $timeout = config('session.lifetime') * 60; // Convert minutes to seconds

            if ($lastActivity && time() - $lastActivity > $timeout) {
                Auth::logout();
                session()->flush();
                return redirect()->route('login')
                    ->with('message', 'Sesi Anda telah berakhir. Silakan login kembali.');
            }

            session(['last_activity' => time()]);
        }

        return $next($request);
    }
}