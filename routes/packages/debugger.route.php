<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Routes;

use Windwalker\Core\Router\RouteCreator;
use Windwalker\Debugger\Module\Ajax\AjaxController;
use Windwalker\Debugger\Module\Index\IndexController;
use Windwalker\Debugger\Module\Index\IndexView;

/** @var RouteCreator $router */

$router->group('debugger')
    ->prefix('/_debugger')
    ->namespace('debugger')
    ->register(function (RouteCreator $router) {
        $router->get('home', '/')
            ->controller(IndexController::class)
            ->view(IndexView::class);

        $router->any('ajax_history', '/ajax/history')
            ->controller(AjaxController::class, 'history');

        $router->any('ajax_last', '/ajax/last')
            ->controller(AjaxController::class, 'last');

        $router->any('ajax_route', '/ajax/data')
            ->controller(AjaxController::class, 'data');
    });
