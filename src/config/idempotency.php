<?php


return [
    'KEY_NAME' => 'Idempotency-Key',

    'CACHE_TIME' => 60,

    'IDEMPOTENT_METHODS' => [
        'POST',
    ],
];