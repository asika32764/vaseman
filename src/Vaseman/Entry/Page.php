<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Entry;

/**
 * The Page class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Page
{
	/**
	 * Property file.
	 *
	 * @var string
	 */
	protected $file;

	/**
	 * Property data.
	 *
	 * @var string
	 */
	protected $data;

	/**
	 * Property route.
	 *
	 * @var string
	 */
	protected $route;

	/**
	 * Class init.
	 *
	 * @param string $file
	 * @param string $data
	 */
	public function __construct($file, $data)
	{
		$this->file = $file;
		$this->data = $data;
	}

	/**
	 * Method to get property Data
	 *
	 * @return  string
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Method to set property data
	 *
	 * @param   string $data
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * Method to get property File
	 *
	 * @return  string
	 */
	public function getFile()
	{
		return $this->file;
	}

	/**
	 * Method to set property file
	 *
	 * @param   string $file
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setFile($file)
	{
		$this->file = $file;

		return $this;
	}

	/**
	 * Method to get property Route
	 *
	 * @return  string
	 */
	public function getRoute()
	{
		return $this->route;
	}

	/**
	 * Method to set property route
	 *
	 * @param   string $route
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setRoute($route)
	{
		$this->route = $route;

		return $this;
	}
}
