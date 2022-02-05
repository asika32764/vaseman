<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'project' => [
        'name' => 'Vaseman'
    ],

    // Which folders you want to generate (Array)
    'folders' => [
        'entries' => '',
    ],

    'links' => [
        'assets' => 'assets'
    ],

    // Plugin classes with namespace (Array)
    'plugins' => [
        \App\Plugin\MenuPlugin::class
    ],

    'components' => [
        'hero-banner' => 'components.hero-banner',
        'breadcrumb' => 'components.breadcrumb',
        'pagination' => 'components.pagination',
    ],

    'system' => [
        'debug' => 0,
        'timezone' => 'UTC',
        'error_reporting' => -1,
    ],
];
