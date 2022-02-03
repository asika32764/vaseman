<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

use Symfony\Component\Dotenv\Dotenv;

define('WINDWALKER_ROOT', dirname(__DIR__));
const WINDWALKER_BIN = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'bin';
const WINDWALKER_CACHE = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'cache';
const WINDWALKER_ETC = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'etc';
const WINDWALKER_LOGS = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'logs';
const WINDWALKER_ROUTES = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'routes';
const WINDWALKER_RESOURCES = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'resources';
const WINDWALKER_SOURCE = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'src';
const WINDWALKER_TEMP = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'tmp';
const WINDWALKER_VIEWS = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'views';
const WINDWALKER_VENDOR = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'vendor';
const WINDWALKER_PUBLIC = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'www';

const WINDWALKER_MIGRATIONS = WINDWALKER_RESOURCES . DIRECTORY_SEPARATOR . 'migrations';
const WINDWALKER_SEEDERS    = WINDWALKER_RESOURCES . DIRECTORY_SEPARATOR . 'seeders';
const WINDWALKER_LANGUAGES  = WINDWALKER_RESOURCES . DIRECTORY_SEPARATOR . 'languages';

$dotenv = new Dotenv();

if (is_file($env = WINDWALKER_ROOT . '/.env')) {
    $dotenv->load($env);
}

if (is_file($env = WINDWALKER_ROOT . '/.env.local')) {
    $dotenv->overload($env);
}

if (is_file($env = WINDWALKER_ROOT . '/.env.' . ($_ENV['APP_ENV'] ?? 'prod'))) {
    $dotenv->overload($env);
}

if (is_file($env = WINDWALKER_ROOT . '/.env.' . ($_ENV['APP_ENV'] ?? 'prod') . '.local')) {
    $dotenv->overload($env);
}

define('WINDWALKER_DEBUG', (bool) env('APP_DEBUG'));
