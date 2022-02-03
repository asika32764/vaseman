<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use function Windwalker\cmd;

return [
    // Prepare assets and install dependencies
    'prepare' => [
        'cross-env COMPOSER_PROCESS_TIMEOUT=600 composer install',
        'yarn install',
        'yarn build',
    ],

    // Prepare for development and reset migration
    'preparedev' => [
        'cross-env NODE_ENV=development php windwalker run prepare',
        function (\Windwalker\Core\Application\ApplicationInterface $app) {
            return $app->createProcess('php windwalker mig:reset --seed -f');
        }
    ],

    // Deploy new version
    'deploy' => [
        'git pull',
        'cross-env COMPOSER_PROCESS_TIMEOUT=600 composer install --no-dev',
        'cross-env APP_ENV=dev php windwalker mig:go -f',
        'cross-env NODE_ENV=production php windwalker run prepare',
        'php windwalker asset:version',
    ],
];
