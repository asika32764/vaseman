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
use Windwalker\Filesystem\Path;

/**
 * The SystemUri class.
 */
class SystemUri
{
    public static function create(Template $template): static
    {
        $destRelDir = (string) $template->getDestFile()->getRelativePath($template->getDestRoot());

        $destRelDir = Path::clean(dirname($destRelDir), '/');

        if (!$destRelDir) {
            $base = './';
        } else {
            $paths = explode('/', $destRelDir);

            $base = str_repeat('../', count($paths));
        }

        return new static($base, $destRelDir);
    }

    public function __construct(public string $path, public string $route)
    {
    }

    public function path(?string $suffix = null): string
    {
        $uri = $this->path;

        if ($suffix !== null) {
            $suffix = ltrim($suffix, '/');
            $uri .= $suffix;
        }

        return $uri;
    }
}
