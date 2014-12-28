<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\File;

use Vaseman\Helper\Set\HelperSet;
use Windwalker\Data\Data;
use Windwalker\Ioc;
use Windwalker\Registry\Registry;

/**
 * The AbstractFileProcessor class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractFileProcessor
{
	/**
	 * Property file.
	 *
	 * @var  \SplFileInfo
	 */
	protected $file;

	/**
	 * Property data.
	 *
	 * @var Data
	 */
	protected $data;

	/**
	 * Property output.
	 *
	 * @var string
	 */
	protected $output;

	/**
	 * Property root.
	 *
	 * @var string
	 */
	protected $root;

	/**
	 * getInstance
	 *
	 * @param string       $type
	 * @param \SplFileInfo $file
	 *
	 * @return AbstractFileProcessor
	 */
	public static function getInstance($type = 'twig', $file = null, $root = null)
	{
		$class = sprintf(__NAMESPACE__ . '\%sProcessor', ucfirst($type));

		if (!class_exists($class))
		{
			throw new \DomainException(ucfirst($type) . ' processor not found.');
		}

		return new $class($file, $root);
	}

	/**
	 * Class init.
	 *
	 * @param \SplFileInfo $file
	 */
	public function __construct(\SplFileInfo $file, $root)
	{
		$this->file = $file;

		$this->data = new Data;

		if (!is_dir($root))
		{
			throw new \RuntimeException('Path: ' . $root . ' not exists.');
		}

		$this->root = realpath($root);
	}

	/**
	 * render
	 *
	 * @return  string
	 */
	abstract public function render();

	/**
	 * Method to get property Data
	 *
	 * @return  Data
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Method to set property data
	 *
	 * @param   Data $data
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * Method to get property Output
	 *
	 * @return  string
	 */
	public function getOutput()
	{
		return $this->output;
	}

	/**
	 * Method to set property output
	 *
	 * @param   string $output
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setOutput($output)
	{
		$this->output = $output;

		return $this;
	}

	/**
	 * Method to get property Root
	 *
	 * @return  string
	 */
	public function getRoot()
	{
		return $this->root;
	}

	/**
	 * Method to set property root
	 *
	 * @param   string $root
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setRoot($root)
	{
		$this->root = $root;

		return $this;
	}

	/**
	 * getLayout
	 *
	 * @return  string
	 */
	public function getLayout()
	{
		return str_replace($this->getRoot(), '', $this->file->getPathname());
	}
}
