<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Laravel have some automatic responses that use a wantsJson method to indetify if the response should
 * develiver JSON. This method uses accept header to decided, so it's easier to set it instead trying to
 * modify laravel custom implementation.
 */
class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}