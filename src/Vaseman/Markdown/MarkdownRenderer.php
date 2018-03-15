<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2018 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

namespace Vaseman\Markdown;

/**
 * The MarkdownRenderer class.
 *
 * @since  __DEPLOY_VERSION__
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
