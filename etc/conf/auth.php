<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

use Windwalker\Core\Auth\Method\DatabaseMethod;
use Windwalker\Core\Provider\AuthProvider;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'providers' => [
        AuthProvider::class,
    ],

    'authentication' => [
        'methods' => [
            'database' => ref('auth.factories.methods.database'),
        ]
    ],

    'authorization' => [
        'policies' => [
            //
        ]
    ],

    'bindings' => [
        //
    ],

    'factories' => [
        'methods' => [
            'database' => create(
                \Lyrasoft\Luna\Auth\LunaAuthMethod::class,
                options: [
                    //
                ]
            )
        ]
    ]
];
