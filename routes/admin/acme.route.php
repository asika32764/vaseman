<?php

namespace App\Routes;

use App\Module\Admin\Acme\AcmeController;
use App\Module\Admin\Acme\AcmeView;
use Windwalker\Core\Router\RouteCreator;

/** @var  RouteCreator $router */

$router->group('acme')
    ->register(function (RouteCreator $router) {
        $router->any('acme', '/acme')
            ->controller(AcmeController::class)
            ->view(AcmeView::class);
    });
