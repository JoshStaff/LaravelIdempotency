<?php

namespace LaravelIdempotency;

class IdempotencyMiddleware {

    public function __construct(array $config)
    {
        $this->config = $config;
    }

}
