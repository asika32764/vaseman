<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Plugin;

use Symfony\Component\Yaml\Yaml;

/**
 * Trait DataLoaderTrait
 */
trait DataLoaderTrait
{
    public function loadYaml(string $file, int $flags = 0): mixed
    {
        if (strlen($file) < PHP_MAXPATHLEN && is_file($file)) {
            return Yaml::parseFile($file, $flags);
        }

        return Yaml::parse($file, $flags);
    }

    public function loadJson(string $file): mixed
    {
        if (strlen($file) < PHP_MAXPATHLEN && is_file($file)) {
            $file = file_get_contents($file);
        }

        return json_decode($file, true);
    }

    public function loadPhp(string $file): mixed
    {
        return include $file;
    }
}
