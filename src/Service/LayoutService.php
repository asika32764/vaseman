<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Service;

use App\Data\Template;
use App\Exception\NoConfigException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * The LayoutService class.
 */
class LayoutService
{
    public function parseTemplateString(string $template): Template
    {
        $templateParts = explode('---', $template, 3);
        $config = [];

        try {
            if (\count($templateParts) !== 3) {
                throw new NoConfigException('No config');
            }

            $config = Yaml::parse($templateParts[1]);

            if ($config) {
                array_shift($templateParts);
                array_shift($templateParts);
            }

            $template = implode('---', $templateParts);
        } catch (ParseException|NoConfigException) {
            $template = implode('---', $templateParts);
        }

        return (new Template([]))
            ->setContent($template)
            ->setConfig($config)
            ->setPermalink($config['permalink'] ?? '');
    }

    /**
     * getBackwards
     *
     * @param string $path
     *
     * @return  string
     */
    public static function getBackwards(string $path): string
    {
        $path = explode('/', $path);
        array_pop($path);

        return str_repeat('../', count($path));
    }
}
