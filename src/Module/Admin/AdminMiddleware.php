<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Middleware\AbstractLifecycleMiddleware;

/**
 * The FrontMiddleware class.
 */
class AdminMiddleware extends AbstractLifecycleMiddleware
{
    public function __construct(
        protected AppContext $app,
        protected AssetService $asset,
    ) {
    }

    /**
     * prepareExecute
     *
     * @param  ServerRequestInterface  $request
     *
     * @return  mixed
     */
    protected function preprocess(ServerRequestInterface $request): void
    {
        $this->asset->js('js/admin/main.js');

        $this->asset->js('https://kit.fontawesome.com/59f5955d51.js');
        $this->asset->js('vendor/bootstrap/dist/js/bootstrap.bundle.js');

        $this->asset->css('vendor/bootstrap/dist/css/bootstrap.min.css');
        $this->asset->css('css/admin/main.css');
    }

    /**
     * postExecute
     *
     * @param  ResponseInterface  $response
     *
     * @return  mixed
     */
    protected function postProcess(ResponseInterface $response): void
    {
    }
}
