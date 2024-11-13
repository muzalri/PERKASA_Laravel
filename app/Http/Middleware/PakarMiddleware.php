<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PakarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        \Log::info('User role: ' . (auth()->check() ? auth()->user()->role : 'Guest'));
        if (!auth()->check() || auth()->user()->role !== 'pakar') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
