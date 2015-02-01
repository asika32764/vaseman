<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\View;

use Vaseman\File\AbstractFileProcessor;
use Vaseman\File\GeneralProcessor;
use Vaseman\Helper\Set\HelperSet;
use Windwalker\Core\Utilities\Iterator\PriorityQueue;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Filesystem;
use Windwalker\Ioc;
use Windwalker\Registry\Registry;
use Windwalker\Utilities\Queue\Priority;
use Windwalker\View\HtmlView;

/**
 * The VasemanFileProcessor class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class VasemanView extends HtmlView
{
	/**
	 * Property config.
	 *
	 * @var Registry
	 */
	protected $config;

	/**
	 * Property paths.
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * render
	 *
	 * @return  AbstractFileProcessor
	 */
	public function render()
	{
		$this->prepareGlobals($this->getData());

		$file = $this->findPaths();

		if ($file === null)
		{
			throw new \UnexpectedValueException('Layout: ' . $this->getLayout() . ' not found');
		}

		$processor = AbstractFileProcessor::getInstance($file->getExtension(), $file, $this->path, $this->config->get('layout.folder'));

		$processor->setData($this->getData());
		$processor->render();

		return $processor;
	}

	/**
	 * findPaths
	 *
	 * @param string $layout
	 *
	 * @return  \SplFileInfo
	 */
	public function findPaths($layout = null)
	{
		$layout = $layout ? : $this->getLayout();

		if (is_file($this->getPath() . '/' . $layout))
		{
			return new \SplFileInfo(realpath($this->getPath() . '/' . $layout));
		}

		$layout = explode('/', $layout);
		$name = array_pop($layout);

		$layout = implode('/', $layout);

		if (is_dir($this->getPath() . '/' . $layout))
		{
			$files = Filesystem::find($this->path . '/' . $layout, $name);

			/** @var \SplFileInfo $file */
			foreach ($files as $file)
			{
				if (File::stripExtension($file->getFilename()) == $name)
				{
					return $file;
				}
			}
		}

		return null;
	}

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

		$uri['base'] = str_repeat('../', count($layout)) ? : './';
		$uri['media'] = str_repeat('../', count($layout)) . 'media/';

		$layout = implode('/', (array) $layout);

		$this->data->uri = $uri->toArray();
		$this->data->helper = new HelperSet;
		$this->data->path = explode('/', $this->getLayout());
	}

	/**
	 * Method to get property Config
	 *
	 * @return  Registry
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * Method to set property config
	 *
	 * @param   Registry $config
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setConfig($config)
	{
		$this->config = $config;

		return $this;
	}

	/**
	 * Method to get property Path
	 *
	 * @return  string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * Method to set property path
	 *
	 * @param   string $path
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setPath($path)
	{
		$this->path = $path;

		return $this;
	}
}
