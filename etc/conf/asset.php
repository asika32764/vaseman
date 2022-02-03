<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

use Windwalker\Core\Asset\AssetProvider;

return [
    // The assets folder in public root, default is `assets`
    'folder' => 'assets',

    // The full assets uri, default is NULL. If you set this uri, it will override `assets.folder`.
    // This is useful if you want to put all assets files on cloud storage.
    'uri' => '',

    'import_map' => [
        'imports' => [
            '@/' => 'js/',
            '@view/' => 'js/view/',
            '@vendor/' => 'vendor/',
            '@core/' => 'vendor/@windwalker-io/core/dist/',
        ],
        'scopes' => []
    ],

    'namespace_base' => 'App\\Module',

    'version_file' => '@cache/asset/asset.version',

    'providers' => [
        AssetProvider::class,
    ],
];
