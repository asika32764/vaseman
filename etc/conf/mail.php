<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2020 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

use Windwalker\Cache\CachePool;
use Windwalker\Cache\Serializer\PhpSerializer;
use Windwalker\Cache\Serializer\RawSerializer;
use Windwalker\Cache\Storage\FileStorage;
use Windwalker\Cache\Storage\NullStorage;
use Windwalker\Core\Attributes\Ref;
use Windwalker\Core\Manager\CacheManager;
use Windwalker\Core\Manager\LoggerManager;
use Windwalker\Core\Manager\MailerManager;
use Windwalker\Core\Provider\MailerProvider;
use Windwalker\DI\Container;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'default' => 'default',

    'from' => 'Windwalker <noreply@windwalker.local>',

    'envelope' => [
        // Must use `new \Symfony\Component\Mime\Address('email', 'name')`
        'sender' => null,
        'recipients' => []
    ],

    'providers' => [
        MailerProvider::class
    ],

    'bindings' => [
    ],

    'factories' => [
        'instances' => [
            'default' => fn (MailerManager $manager) => $manager->createMailer(
                [
                    'envelope' => $manager->config('envelope'),
                    'dsn' => env('MAIL_DSN_DEFAULT'),

                    // 'dsn' => [
                    //     'scheme' => env('MAIL_TRANSPORT'),
                    //     'host' => env('MAIL_HOST'),
                    //     'user' => env('MAIL_USER') ?: null,
                    //     'password' => env('MAIL_PASSWORD') ?: null,
                    //     'port' => ((int) env('MAIL_PORT')) ?: null,
                    //     'options' => [
                    //         'verify_peer' => env('MAIL_VERIFY')
                    //     ],
                    // ],

                    // Auto CC to emails, use (,) separate addresses.
                    'cc' => env('MAIL_CC'),

                    // Auto BCC to emails, use (,) separate addresses.
                    'bcc' => env('MAIL_BCC')
                ]
            )
        ],
    ],
];
