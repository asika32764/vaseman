<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Controller\Page;

use Vaseman\Processor\AbstractFileProcessor;
use Vaseman\View\Page\PageHtmlView;
use Windwalker\Core\Controller\AbstractController;
use Windwalker\Ioc;
use Windwalker\Structure\Structure;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends AbstractController
{
	/**
	 * Property processor.
	 *
	 * @var  AbstractFileProcessor
	 */
	protected $processor;

	/**
	 * Method to get property Processor
	 *
	 * @return  AbstractFileProcessor
	 */
	public function getProcessor()
	{
		return $this->processor;
	}

	/**
	 * Method to set property processor
	 *
	 * @param   AbstractFileProcessor $processor
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setProcessor($processor)
	{
		$this->processor = $processor;

		return $this;
	}

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

		$path = $this->config->get('layout.path', $this->app->get('project.path.entries'));

		$view->setPath($path);
		// $view->addPath($this->app->get('project.path.layouts'), Priority::NORMAL);

		$view['path'] = (array) $paths;

		$paths = $paths ? implode('/', (array) $paths) : 'index';

		// URI
		$layout = explode('/', str_replace('\\', '/', $paths));
		array_pop($layout);

		// URI Path
		$path = explode('/', str_replace('\\', '/', $paths));

		Ioc::getContainer()->share('view.data.path', $path);

		$uri = new Structure;
		$uri['base'] = str_repeat('../', count($layout)) ? : './';
		$uri['media'] = str_repeat('../', count($layout)) . 'media/';

		Ioc::getContainer()->share('view.data.uri', $uri);

        /** @var AbstractFileProcessor $processor */
        $this->processor = $processor = $view->setLayout($paths)->render();

		return $processor->getOutput();
	}
}
