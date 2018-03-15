<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Test\src\Twig;

/**
 * The TestTwigExtension class.
 *
 * @since  {DEPLOY_VERSION}
 */
class TestTwigExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'test';
    }

    /**
     * getGlobals
     *
     * @return  array
     */
    public function getGlobals()
    {
        return [
            'flower' => 'sakura'
        ];
    }
}
