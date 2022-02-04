<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Edge;

use App\Data\Template;
use Windwalker\Core\Edge\Component\XComponent;
use Windwalker\Edge\Component\ComponentExtension;
use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader;

/**
 * The EdgeFactory class.
 */
class EdgeFactory
{
    public function createEdge(string $layouts, Template $template): Edge
    {
        $loader = new EdgeFileLoader([$layouts]);
        $loader = new VasemanEdgeLoader($loader);

        $edge = new Edge($loader);

        $components = $template->getConfig()['components'] ?? [];
        $components['component'] = XComponent::class;
        $components['template'] = XComponent::class;

        $edge->addExtension(new ComponentExtension($edge, $components));

        return $edge;
    }
}
