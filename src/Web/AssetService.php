<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Web;

/**
 * The AssetService class.
 *
 * @property-read string $path
 */
class AssetService
{
    public function __construct(protected SystemUri $uri)
    {
    }

    public function path(string $suffix = ''): string
    {
        $suffix = ltrim($suffix, '/');
        $suffix = 'assets/' . $suffix;

        return $this->uri->path($suffix);
    }

    public function __get(string $name)
    {
        if ($name === 'path') {
            return $this->path();
        }

        throw new \BadMethodCallException('No property: ' . $name);
    }
}
