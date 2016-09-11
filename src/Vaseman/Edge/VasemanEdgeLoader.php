<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Vaseman\Edge;

use Vaseman\Processor\EdgeProcessor;
use Windwalker\Edge\Loader\EdgeFileLoader;

/**
 * The VasemanEdgeLoader class.
 *
 * @since  {DEPLOY_VERSION}
 */
class VasemanEdgeLoader extends EdgeFileLoader
{
	/**
	 * Property processor.
	 *
	 * @var  EdgeProcessor
	 */
	protected $processor;

	/**
	 * loadFile
	 *
	 * @param   string  $path
	 *
	 * @return  string
	 */
	public function load($path)
	{
		return $this->processor->prepareData(file_get_contents($path));
	}

	/**
	 * Method to get property Processor
	 *
	 * @return  EdgeProcessor
	 */
	public function getProcessor()
	{
		return $this->processor;
	}

	/**
	 * Method to set property processor
	 *
	 * @param   EdgeProcessor $processor
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setProcessor($processor)
	{
		$this->processor = $processor;

		return $this;
	}
}
