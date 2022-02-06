<?php

/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Event;

use App\Data\Template;

/**
 * Trait ProcessEventTrait
 */
trait ProcessEventTrait
{
    protected Template $template;

    protected array $data = [];

    /**
     * @return Template
     */
    public function getTemplate(): Template
    {
        return $this->template;
    }

    /**
     * @param  Template  $template
     *
     * @return  static  Return self to support chaining.
     */
    public function setTemplate(Template $template): static
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return array
     */
    public function &getData(): array
    {
        return $this->data;
    }

    /**
     * @param  array  $data
     *
     * @return  static  Return self to support chaining.
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
