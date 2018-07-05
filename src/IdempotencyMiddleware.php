<?php

namespace LaravelIdempotency;

use Closure;

class IdempotencyMiddleware
{

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
