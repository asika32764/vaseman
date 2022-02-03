<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2020 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

use Windwalker\Console\CommandWrapper;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\Csrf;
use Windwalker\Core\Attributes\Json;
use Windwalker\Core\Attributes\JsonApi;
use Windwalker\Core\Attributes\Module;
use Windwalker\Core\Attributes\Ref;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\DI\Attributes\AttributeType;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\DI\Attributes\Decorator;
use Windwalker\DI\Attributes\Inject;
use Windwalker\DI\Attributes\Service;
use Windwalker\DI\Attributes\Setup;
use Windwalker\Utilities\Arr;

use function Windwalker\include_arrays;

return Arr::mergeRecursive(
    // Load with namespace,
    [
        'factories' => include_arrays(__DIR__ . '/di/*.php'),
        'providers' => [
            //
        ],
        'bindings' => [
            //
        ],
        'aliases' => [
            //
        ],
        'layouts' => [
            //
        ],
        'attributes' => [
            //
        ]
    ]
);
