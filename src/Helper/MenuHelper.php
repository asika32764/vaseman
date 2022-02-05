<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Helper;

use App\Data\Template;
use App\Web\SystemUri;

/**
 * The MenuHelper class.
 */
class MenuHelper
{
    public function __construct(protected SystemUri $uri)
    {
    }

    public function active(string $key, string $className = 'active'): string
    {
        $route = $this->uri->route;

        if (str_contains($route, $key)) {
            return $className;
        }

        return '';
    }
}
