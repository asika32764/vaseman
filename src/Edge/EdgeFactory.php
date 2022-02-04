<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Edge;

use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader;

/**
 * The EdgeFactory class.
 */
class EdgeFactory
{
    public function createEdge(string $layouts): Edge
    {
        $loader = new EdgeFileLoader([$layouts]);
        $loader = new VasemanEdgeLoader($loader);

        return new Edge($loader);
    }
}
