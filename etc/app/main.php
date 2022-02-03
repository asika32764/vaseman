<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2020 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

$env = env('APP_ENV');

return array_merge(
    require __DIR__ . '/windwalker.php',
    [
        'middlewares' => [
            \Windwalker\Core\Middleware\RoutingMiddleware::class
        ],

        'listeners' => [
            //
        ]
    ],
    require __DIR__ . '/../config.php'
);
