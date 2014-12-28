<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\File;

use Michelf\MarkdownExtra;

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
	 */
	public function render()
	{
		$md = file_get_contents($this->file->getPathname());

		$md = $this->prepareData($md);

		$markdown = new MarkdownExtra;

		$content = $markdown->defaultTransform($md);

		return $this->output = $this->renderLayout($content);
	}
}
