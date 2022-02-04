<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Web;

use App\Data\Template;
use App\Event\DataProvideEvent;
use App\Helper\HelperSet;
use App\Plugin\PluginRegistry;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Event\EventAwareInterface;
use Windwalker\Event\EventAwareTrait;

/**
 * The GlobalVariables class.
 */
class GlobalVariables
{
    public function __construct(protected ConsoleApplication $app, protected PluginRegistry $pluginRegistry)
    {
    }

    public function createGlobals(Template $template): array
    {
        $uri = SystemUri::create($template);
        $asset = new AssetService($uri);
        $config = $template->getConfig();
        $route = $uri->route;
        $helper = $this->app->make(
            HelperSet::class,
            [
                Template::class => $template,
                SystemUri::class => $uri,
                AssetService::class => $asset,
            ]
        );

        $data = compact('uri', 'asset', 'config', 'route', 'template', 'helper');

        $event = $this->pluginRegistry->emit(
            DataProvideEvent::class,
            compact('template', 'data')
        );

        return $event->getData();
    }
}
