<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Controller\Page;

use Vaseman\View\Page\PageHtmlView;
use Windwalker\Core\Controller\Controller;
use Windwalker\Utilities\Queue\Priority;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$paths = $this->input->getVar('paths', array());

		$view = new PageHtmlView;
		$view->setConfig($this->config);

		$view->addPath($this->app->get('project.path.data'), Priority::HIGH);
		$view->addPath($this->app->get('project.path.root'), Priority::NORMAL);

		$view['path'] = (array) $paths;

		$paths = $paths ? implode('/', (array) $paths) : 'index';

		return $view->setLayout($paths)->render();
	}
}
