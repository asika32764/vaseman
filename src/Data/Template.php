<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Data;

use Windwalker\Data\ValueObject;

/**
 * The Template class.
 */
class Template extends ValueObject
{
    public string $content = '';

    public array $config = [];

    public string $permalink = '';

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param  string  $content
     *
     * @return  static  Return self to support chaining.
     */
    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param  array  $config
     *
     * @return  static  Return self to support chaining.
     */
    public function setConfig(array $config): static
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return string
     */
    public function getPermalink(): string
    {
        return $this->permalink;
    }

    /**
     * @param  string  $permalink
     *
     * @return  static  Return self to support chaining.
     */
    public function setPermalink(string $permalink): static
    {
        $this->permalink = $permalink;

        return $this;
    }
}
