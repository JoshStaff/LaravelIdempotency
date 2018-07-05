
# Laravel Idempotency
A super simple, customisable and automatically registering middleware to help you ensure your requests are Idempotent when it’s required.

Inspired by the guys at Stripe https://stripe.com/blog/idempotency and the realisation of how important this little feature is I mocked up this package. 

Currently, I believe it’s only functioning on 5.6.x. If there is a demand, I’m happy to update the package to support earlier versions; just open an issue.

Installing the package on 5.6 is as simple as `composer require joshuastaff/laravel-idempotency`. The automatic service provider resolution will do the rest for you. You can publish the config via: `php artisan vendor:publish --tag=config` and customise the config there. If there are any additional options you require, give me a shout.

Utilising this in your routes can be done as followed:
```
Route::post('hello', function() {
    return 'here';
})->middleware('idempotent');
```

Please open any issues / pull requests, happy to help.

TODO:

Intending on automagically re-attempting the request using sensible jitter times. Once the request has failed after a set amount of attempts, I'd like to defer the request to the Laravel Queues. If this functionality is useful – Please shout.
