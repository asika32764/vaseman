<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Edge;

use Windwalker\Edge\Exception\LayoutNotFoundException;
use Windwalker\Edge\Loader\EdgeFileLoader;
use Windwalker\Edge\Loader\EdgeLoaderInterface;

/**
 * The VasemanEdgeLoader class.
 */
class VasemanEdgeLoader implements EdgeLoaderInterface
{
    public function __construct(protected EdgeFileLoader $fileLoader)
    {
    }

    public function find(string $key): string
    {
        if (strlen($key) <= PHP_MAXPATHLEN) {
            try {
                $found = $this->fileLoader->find($key);

                if ($found) {
                    return $found;
                }
            } catch (LayoutNotFoundException) {
                //
            }
        }

        return $key;
    }

    public function load(string $path): string
    {
        if (strlen($path) <= PHP_MAXPATHLEN && is_file($path)) {
            return file_get_contents($path);
        }

        return $path;
    }

    public function has(string $key): bool
    {
        if (strlen($key) <= PHP_MAXPATHLEN && $this->fileLoader->has($key)) {
            return true;
        }

        return true;
    }
}
