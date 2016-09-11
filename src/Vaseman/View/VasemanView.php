<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\View;

use Vaseman\Processor\AbstractFileProcessor;
use Vaseman\Helper\Set\HelperSet;
use Windwalker\Data\Data;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Filesystem;
use Windwalker\Structure\Structure;

/**
 * The VasemanFileProcessor class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class VasemanView extends \Windwalker\Core\View\HtmlView
{
	/**
	 * Property config.
	 *
	 * @var Structure
	 */
	protected $config;

	/**
	 * Property paths.
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * Property allowPageExts.
	 *
	 * @var  array
	 */
	protected $allowPageExts = [
		'.twig',
		'.blade.php',
		'.edge.php'
	];

	/**
	 * doRender
	 *
	 * @param  Data $data
	 *
	 * @return string
	 */
	protected function doRender($data)
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
				$filename = $file->getFilename();

				foreach ($this->allowPageExts as $ext)
				{
					$lookName = $name . $ext;

					if ($lookName == $filename)
					{
						return $file;
					}
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
		$this->data->helper = new HelperSet($this);
		$this->data->path = explode('/', $this->getLayout());

		$this->data->bind(GlobalProvider::loadGlobalProvider());
	}

	/**
	 * Method to get property Config
	 *
	 * @return  Structure
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * Method to set property config
	 *
	 * @param   Structure $config
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
