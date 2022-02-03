<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace App\Processor;

use ParsedownExtra;
use App\Markdown\MarkdownRenderer;

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
    public function render(): string
    {
        $md = file_get_contents($this->file->getPathname());

        $md = $this->prepareData($md);

        return $this->output = $this->renderParentLayout(MarkdownRenderer::render($md));
    }
}
