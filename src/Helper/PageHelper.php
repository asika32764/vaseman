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

/**
 * The PageHelper class.
 */
class PageHelper
{
    public function __construct(protected Template $template)
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
}
