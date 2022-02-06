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
use Windwalker\Filesystem\FileObject;

/**
 * The CopyFileProcessor class.
 */
class CopyFileProcessor implements ProcessorInterface
{
    public function process(Template $template, array $data = []): FileObject
    {
        $content = (string) $template->getSrc()->read();
        $dest = $template->getDestFile();

        if ($content !== (string) $dest->read()) {
            $dest = $dest->write($content);
        }

        return $dest;
    }
}
