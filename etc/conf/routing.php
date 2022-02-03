<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2020 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

use Windwalker\Core\Provider\RouterProvider;

return [
    'routes' => [
        __DIR__ . '/../../routes/main.route.php'
    ],

    'providers' => [
        RouterProvider::class
    ],

    'bindings' => [
        //
    ],

    'extends' => [
        //
    ]
];
