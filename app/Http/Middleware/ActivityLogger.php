<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (auth()->check() && $request->method() !== 'GET') {
            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => $request->method() . ' ' . $request->path(),
                'ref_type' => null,
                'ref_id' => null,
                'metadata' => [
                    'ip' => $request->ip(),
                    'user_agent' => (string) $request->userAgent(),
                ],
            ]);
        }

        return $response;
    }
}
