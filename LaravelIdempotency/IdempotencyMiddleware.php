<?php

namespace LaravelIdempotency\Core;

class IdempotencyMiddleware {

    public function __construct(array $config)
    {
        $this->config = $config;
    }

}
