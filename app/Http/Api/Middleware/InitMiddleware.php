<?php

namespace App\Http\Api\Middleware;

use \Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InitMiddleware
{
    /**
     * Handle an incoming request.
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
