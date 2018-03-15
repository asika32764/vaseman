<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Twig\Token;

use Michelf\MarkdownExtra;
use Vaseman\Markdown\MarkdownRenderer;

/**
 * The MarkdownNode class.
 *
 * @since  {DEPLOY_VERSION}
 */
class MarkdownNode extends \Twig_Node
{
    /**
     * Class init.
     *
     * @param \Twig_NodeInterface $value
     * @param int                 $line
     * @param string              $tag
     */
    public function __construct(\Twig_NodeInterface $value, $line, $tag = null)
    {
        parent::__construct(['value' => $value], [], $line, $tag);
    }

    /**
     * compile
     *
     * @param \Twig_Compiler $compiler
     *
     * @return  void
     * @throws \Exception
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $data = $this->getNode('value')->getAttribute('data');

        $data = MarkdownRenderer::render($data);

        $compiler->write('echo ')->string($data)->raw(';');
    }
}
