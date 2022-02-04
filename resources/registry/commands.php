<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'up' => \App\Command\UpCommand::class,
    'init' => \App\Command\InitCommand::class,
    'make:plugin' => \App\Command\MakePluginCommand::class,
    'make:helper' => \App\Command\MakeHelperCommand::class,
];
