<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Error;

use Windwalker\Core\Error\ErrorHandler;

/**
 * The ConsoleErrorHandler class.
 *
 * @since  {DEPLOY_VERSION}
 */
class ConsoleErrorHandler extends ErrorHandler
{
    /**
     * error
     *
     * @param int    $code
     * @param string $message
     * @param string $file
     * @param int    $line
     * @param mixed  $context
     *
     * @return  void
     *
     * @throws \ErrorException
     */
    public static function error($code, $message, $file, $line, $context)
    {
        if (error_reporting() === 0) {
            return;
        }

        $content = sprintf('%s. File: %s (line: %s)', $message, $file, $line);

        throw new \ErrorException($content, $code, 1, $file, $line);
    }

    /**
     * registerErrorHandler
     *
     * @param bool $restore
     * @param int  $type
     *
     * @return  void
     */
    public static function register($restore = true, $type = null)
    {
        if ($restore) {
            static::restore();
        }

        set_error_handler([get_called_class(), 'error']);
    }

    /**
     * restore
     *
     * @return  void
     */
    public static function restore()
    {
        restore_error_handler();
    }
}
