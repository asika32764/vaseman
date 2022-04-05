<?php

/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Event;

use Windwalker\Event\AbstractEvent;

/**
 * The BeforeProcessEvent class.
 */
class BeforeProcessEvent extends AbstractEvent
{
    use ProcessEventTrait;

    protected bool $skip = false;

    /**
     * @return bool
     */
    public function isSkip(): bool
    {
        return $this->skip;
    }

    /**
     * @param  bool  $skip
     *
     * @return  static  Return self to support chaining.
     */
    public function setSkip(bool $skip): static
    {
        $this->skip = $skip;

        return $this;
    }
}
