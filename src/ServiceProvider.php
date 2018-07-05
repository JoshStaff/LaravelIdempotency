<?php

namespace LaravelIdempotency;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravelidempotency', function () {
            return new IdempotencyMiddleware(config('idempotency'));
        });
    }
}