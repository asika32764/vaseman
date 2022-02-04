<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Processor;

use App\Data\Template;
use React\Filesystem\Filesystem;
use React\Promise\PromiseInterface;

/**
 * The CopyFileProcessor class.
 */
class CopyFileProcessor implements ProcessorInterface
{
    public function createProcessor(Template $template, array $data = []): \Closure
    {
        return static function (Filesystem $filesystem) use ($template): PromiseInterface {
            return $filesystem->file($template->getDestFile()->getPathname())
                ->putContents($template->getContent());
        };
    }
}
