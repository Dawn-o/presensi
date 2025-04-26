<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOfficeIP
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $officeIp = env('OFFICE_WIFI_IP');
        $clientIp = $request->ip();

        if ($clientIp !== $officeIp) {
            return response()->json(['error' => 'Access denied. You must be connected to the office Wi-Fi.'], 403);
        }

        return $next($request);
    }
}
