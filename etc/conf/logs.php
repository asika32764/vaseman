<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    MIT
 */

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Windwalker\Core\Manager\LoggerManager;
use Windwalker\Core\Provider\LoggerProvider;
use Windwalker\Core\Provider\MonologProvider;
use Windwalker\Core\Service\LoggerService;
use Windwalker\DI\Container;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'dir' => '',

    'default' => 'default',
    'channels' => [
        'none' => ref('logs.factories.loggers.none'),
        'default' => ref('logs.factories.loggers.default'),
    ],

    'max_files' => env('LOG_MAX_FILES'),

    'global_handlers' => [],
    'global_processors' => [
        PsrLogMessageProcessor::class
    ],

    'providers' => [
        LoggerProvider::class
    ],
    'bindings' => [
        //
    ],
    'aliases' => [
        //
    ],
    'factories' => [
        'instances' => [
            'none' => create(NullLogger::class),
            'default' => function (string $instanceName) {
                return MonologProvider::logger(
                    $instanceName,
                    [
                        ref('logs.factories.handlers.rotating'),
                    ]
                );
            },
        ],
        'handlers' => [
            'stream' => create(StreamHandler::class),
            'rotating' => function (Container $container, string $instanceName, ...$args) {
                $args['filename'] ??= $args[0] ?? $container->getParam('@logs') . '/' . $instanceName . '.log';

                unset($args[0]);

                $args['maxFiles'] = (int) ($container->getParam('logs.max_files') ?? 7);

                return create(RotatingFileHandler::class, ...$args);
            },
        ],
        'formatters' => [
            'line_formatter' => create(LineFormatter::class, null, null, true)
        ]
    ],
];
