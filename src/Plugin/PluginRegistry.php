<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Plugin;

use Windwalker\DI\Container;
use Windwalker\Event\EventAwareInterface;
use Windwalker\Event\EventAwareTrait;

/**
 * The PluginRegistry class.
 */
class PluginRegistry implements EventAwareInterface
{
    use EventAwareTrait;

    public function __construct(protected Container $container)
    {
    }

    public function add(string $className): void
    {
        if ($this->container->has($className)) {
            $plugin = $this->container->get($className);
        } else {
            $plugin = $this->container->createSharedObject($className);
        }

        $this->subscribe($plugin);
    }
}
