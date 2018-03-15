<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2018 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

namespace Vaseman\Edge;

use Windwalker\Edge\Extension\EdgeExtensionInterface;

/**
 * The VasemanEdgeExtension class.
 *
 * @since  __DEPLOY_VERSION__
 */
class VasemanEdgeExtension implements EdgeExtensionInterface
{
    /**
     * getName
     *
     * @return  string
     */
    public function getName()
    {
        return 'vaseman';
    }

    /**
     * getDirectives
     *
     * @return  callable[]
     */
    public function getDirectives()
    {
        return [
            'markdown' => [$this, 'markdown'],
            'endmarkdown' => [$this, 'endmarkdown'],
        ];
    }

    /**
     * getGlobals
     *
     * @return  array
     */
    public function getGlobals()
    {
        return [];
    }

    /**
     * getParsers
     *
     * @return  callable[]
     */
    public function getParsers()
    {
        return [];
    }

    /**
     * markdown
     *
     * @param string $expression
     *
     * @return  string
     *
     * @since  __DEPLOY_VERSION__
     */
    public function markdown($expression)
    {
        return "<?php \Vaseman\Markdown\MarkdownRenderer::start(); ?>";
    }

    /**
     * endmarkdown
     *
     * @param string $expression
     *
     * @return  string
     *
     * @since  __DEPLOY_VERSION__
     */
    public function endmarkdown($expression)
    {
        return "<?php echo \Vaseman\Markdown\MarkdownRenderer::end(); ?>";
    }
}
