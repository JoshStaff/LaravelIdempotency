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
        if ($this->nonIndempotentRequest()) {
            return $next($request);
        }

        $cached = $this->requiresCaching($request, $next);

        if (!$cached) {
            return cache()->get(request()->header(config('idempotency.KEY_NAME')));
        }

        return $next($request);
    }

    /**
     * @return bool
     */
    private function nonIndempotentRequest()
    {
        return !(
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
