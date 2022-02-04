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
use Windwalker\Utilities\Str;

use function Windwalker\fs;

/**
 * The PhpProcessor class.
 */
class PhpProcessor implements ProcessorInterface
{
    public function __construct(protected ProcessorFactory $processorFactory)
    {
    }

    public function createProcessor(Template $template, array $data = []): \Closure
    {
        $srcFile = $template->getSrc()->getPathname();

        if (str_ends_with($srcFile, '.blade.php')) {
            $destFile = Str::removeRight((string) $template->getDestFile(), '.blade.php') . '.html';
            $template->setDestFile(fs($destFile, $template->getDestFile()->getRoot()));
        }

        if (str_ends_with($srcFile, '.edge.php')) {
            $destFile = Str::removeRight((string) $template->getDestFile(), '.edge.php') . '.html';
            $template->setDestFile(fs($destFile, $template->getDestFile()->getRoot()));
        }

        if (str_ends_with($srcFile, '.blade.php') || str_ends_with($srcFile, '.edge.php')) {
            return $this->processorFactory->create('blade')->createProcessor($template);
        }

        throw new \RuntimeException('Not support pure php file now.');
    }
}
