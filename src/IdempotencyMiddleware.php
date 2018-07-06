<?php

namespace LaravelIdempotency;

use Closure;

class IdempotencyMiddleware
{

    /**
     * @param $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->indempotentRequest()) {
            return $next($request);
        }

        if (!$this->requiresCaching($request, $next)) {
            return cache()->get(request()->header(config('idempotency.KEY_NAME')));
        }

        return $next($request);
    }

    /**
     * @return bool
     */
    private function indempotentRequest()
    {
        return (
            in_array(request()->getMethod(), config('idempotency.IDEMPOTENT_METHODS'))
            || request()->header(config('idempotency.KEY_NAME'))
        );
    }

    /**
     * @param $request
     * @param $next
     *
     * @return bool
     */
    private function requiresCaching($request, $next)
    {
        return cache()->add(request()->header(config('idempotency.KEY_NAME')), $next($request), config('idempotency.CACHE_TIME'));
    }
}
