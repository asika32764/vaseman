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
use Windwalker\Utilities\Str;
use Windwalker\Utilities\StrNormalize;

/**
 * The PageHelper class.
 */
class PageHelper
{
    public function __construct(protected Template $template, protected SystemUri $uri)
    {
    }

    public function title(string $title, $separator = ' | '): string
    {
        $site = $this->template->getConfig()['project']['name'] ?? '';

        $titles = [
            trim($title),
            trim($site)
        ];

        $titles = array_filter($titles, 'strlen');

        return implode($separator, $titles);
    }

    public function bodyClass(): string
    {
        $route = $this->uri->route;
        $segments = explode('/', $route);
        $layout = array_pop($segments);

        $view = StrNormalize::toKebabCase(implode('-', $segments)) ?: 'home';
        $layout = $layout ?: $view;

        return 'view-' . $view . ' layout-' . $layout . ' route-' . str_replace('/', '-', $route);
    }
}
