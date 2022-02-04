<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Renderer;

/**
 * The MarkdownRenderer class.
 */
class MarkdownRenderer
{
    /**
     * start
     *
     * @return  void
     *
     * @since  __DEPLOY_VERSION__
     */
    public static function start()
    {
        ob_start();
    }

    /**
     * end
     *
     * @return  string
     *
     * @throws \Exception
     *
     * @since  __DEPLOY_VERSION__
     */
    public static function end()
    {
        $content = ob_get_contents();

        ob_end_clean();

        return static::render($content);
    }

    /**
     * render
     *
     * @param string $text
     *
     * @return  string
     *
     * @throws \Exception
     *
     * @since  __DEPLOY_VERSION__
     */
    public static function render($text)
    {
        $markdown = new \ParsedownExtra();

        return $markdown->text($text);
    }
}
