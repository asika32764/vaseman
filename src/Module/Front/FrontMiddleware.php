<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Unicorn\Script\UnicornScript;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\Middleware\AbstractLifecycleMiddleware;

/**
 * The FrontMiddleware class.
 */
class FrontMiddleware extends AbstractLifecycleMiddleware
{
    public function __construct(
        protected AppContext $app,
        protected AssetService $asset,
        protected HtmlFrame $htmlFrame,
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
        $this->asset->js('js/main.js');

        $this->asset->css('vendor/bootstrap/dist/css/bootstrap.min.css');
        $this->asset->css('css/front/main.css');

        $this->htmlFrame->setSiteName('Windwalker');
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
