<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Twig;

use Vaseman\Twig\Token\MarkdownTokenParser;

/**
 * The VasemanTwigExtension class.
 *
 * @since  {DEPLOY_VERSION}
 */
class VasemanTwigExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'vaseman';
    }

    /**
     * getTokenParsers
     *
     * @return  array
     */
    public function getTokenParsers()
    {
        return [
            new MarkdownTokenParser
        ];
    }
}
