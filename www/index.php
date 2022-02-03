<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace App\Public;

use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Runtime\Runtime;
use Windwalker\Http\Event\RequestEvent;
use Windwalker\Http\Server\HttpServer;

$root = __DIR__ . '/..';

if (!is_file($root . '/vendor/autoload.php')) {
    exit('Please run `composer install` First.');
}

include $root . '/vendor/autoload.php';

include __DIR__ . '/../etc/define.php';

Runtime::ipBlock(['dev'], env('DEV_ALLOW_IPS'));

Runtime::boot(WINDWALKER_ROOT, __DIR__);

Runtime::loadConfig(Runtime::getRootDir() . '/etc/runtime.php');

$container = Runtime::getContainer();

/** @var HttpServer $server */
/** @var WebApplication $app */
$server = $container->resolve('factories.servers.http');
$app = $container->resolve('factories.apps.main');
$app->boot();
$server->getEventDispatcher()->addDealer($app->getEventDispatcher());

$server->on('request', function (RequestEvent $event) use ($app) {
    $req = $event->getRequest();

    $event->setResponse($app->execute($req));
});

$server->listen();

$app->terminate();
