<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Processor;

use ParsedownExtra;
use Vaseman\Markdown\MarkdownRenderer;

/**
 * The MarkdownProcessor class.
 *
 * @since  {DEPLOY_VERSION}
 */
class MarkdownProcessor extends TwigProcessor
{
    /**
     * render
     *
     * @return  string
     * @throws \Exception
     */
    public function render()
    {
        $md = file_get_contents($this->file->getPathname());

        $md = $this->prepareData($md);

        return $this->output = $this->renderParentLayout(MarkdownRenderer::render($md));
    }
}
