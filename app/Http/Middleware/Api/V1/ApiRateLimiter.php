<?php

namespace App\Http\Middleware\Api\V1;

use Closure;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ApiRateLimiter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (RateLimiter::tooManyAttempts($request->user()?->id ?: $request->ip . "|" . $request->method . "|" . $request->path . "|" . $request->path, $perMinute = 30))
        {
            return response()->error($request, null, 'Too many attempts. Please try again later.', 429);
        }

        RateLimiter::increment($request->user()?->id ?: $request->ip . "|" . $request->method . "|" . $request->path . "|" . $request->path);

        return $next($request);
    }
}
