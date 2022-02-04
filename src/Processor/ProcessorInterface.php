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

/**
 * Interface ProcessorInterface
 */
interface ProcessorInterface
{
    public function createProcessor(Template $template, array $data = []): \Closure;
}
