<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2020 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

use Windwalker\Core\Manager\CryptoManager;
use Windwalker\Crypt\Symmetric\OpensslCipher;
use Windwalker\Crypt\Symmetric\SodiumCipher;

use function Windwalker\DI\create;

return [
    'crypto' => [
        'default' => 'sodium',

        'factories' => [
            'instances' => [
                'sodium' => create(SodiumCipher::class),
                'blowfish' => create(OpensslCipher::class, 'blowfish')
            ]
        ]
    ],

    'hasher' => [
        //
    ],

    'bindings' => [
        CryptoManager::class
    ],
];
