<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Event;

use App\Data\Template;
use Windwalker\Event\AbstractEvent;

/**
 * The DataProvideEvent class.
 */
class DataProvideEvent extends AbstractEvent
{
    use ProcessEventTrait;
}
