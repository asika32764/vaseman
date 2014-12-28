<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\View\Page;

use Vaseman\Helper\Set\HelperSet;
use Vaseman\View\VasemanView;
use Windwalker\Core\View\TwigHtmlView;
use Windwalker\Ioc;
use Windwalker\Registry\Registry;

/**
 * The PageHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PageHtmlView extends VasemanView
{
	/**
	 * prepareGlobals
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareGlobals($data)
	{
		$uri = new Registry;

		$layout = explode('/', $this->getLayout());
		array_pop($layout);
		$layout = implode('/', (array) $layout);

		$uri['uri.base.path'] = $layout;
		$uri['uri.media.path'] = 'media';

		$this->data->uri = Ioc::get('system.uri');
		$this->data->helper = new HelperSet;
		$this->data->path = explode('/', $this->getLayout());
	}
}
