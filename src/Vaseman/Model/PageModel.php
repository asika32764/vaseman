<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Model;

use Vaseman\Entry\Entry;
use Vaseman\Entry\Page;
use Vaseman\View\Page\PageHtmlView;
use Windwalker\Core\Model\Model;
use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Filesystem\File;

/**
 * The Page class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PageModel extends Model
{
	/**
	 * generateEntries
	 *
	 * @param   Entry[]  $entries
	 *
	 * @return  Page[]
	 */
	public function generateEntries($entries)
	{
		$results = array();

		foreach ($entries as $entry)
		{
			$results[] = $this->generateEntry($entry);
		}

		return $results;
	}

	/**
	 * generateEntry
	 *
	 * @param   Entry $entry
	 *
	 * @return  Page
	 */
	public function generateEntry(Entry $entry)
	{
		$view = new PageHtmlView;

		$layout = File::stripExtension($entry->getPath());

		$html = $view->setLayout($layout)->render();

		$file = $layout . '.html';

		return new Page($file, $html);
	}
}
