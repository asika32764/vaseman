<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Web;

use function Windwalker\uid;

/**
 * The AssetService class.
 *
 * @property-read string $path
 */
class AssetService
{
    public string $v = '';

    public function __construct(protected SystemUri $uri)
    {
        $this->v = uid();
    }

    public function path(string $suffix = '', bool $v = true): string
    {
        if ($suffix === '') {
            $v = false;
        }

        $suffix = ltrim($suffix, '/');
        $suffix = 'assets/' . $suffix;

        if ($v) {
            if (str_contains($suffix, '?')) {
                $suffix .= '&' . $this->v;
            } else {
                $suffix .= '?' . $this->v;
            }
        }

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
