<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Processor;

use Windwalker\DI\Container;
use Windwalker\Utilities\StrNormalize;

/**
 * The ProcessorFactory class.
 */
class ProcessorFactory
{
    public function __construct(protected Container $container)
    {
    }

    public function create(string $type): ProcessorInterface
    {
        $className = sprintf(
            '%s\%sProcessor',
            __NAMESPACE__,
            StrNormalize::toPascalCase($type)
        );

        if (!class_exists($className)) {
            $className = CopyFileProcessor::class;
        }

        return $this->container->newInstance($className);
    }
}
