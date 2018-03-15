<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Processor\Helper;

/**
 * The ProcessorHelper class.
 *
 * @since  {DEPLOY_VERSION}
 */
abstract class ProcessorHelper
{
    /**
     * getBackwards
     *
     * @param string $path
     *
     * @return  string
     */
    public static function getBackwards($path)
    {
        $path = explode('/', $path);
        array_pop($path);

        return str_repeat('../', count($path));
    }
}
