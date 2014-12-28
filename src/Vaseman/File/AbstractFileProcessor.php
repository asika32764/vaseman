<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\File;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Windwalker\Data\Data;
use Windwalker\Registry\Registry;

/**
 * The AbstractFileProcessor class.
 *
 * @property-read  Registry  $config  Page config.
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
	 * Property folder.
	 *
	 * @var  string
	 */
	protected $folder;

	/**
	 * Property config.
	 *
	 * @var Registry
	 */
	protected $config;

	/**
	 * Property target.
	 *
	 * @var string
	 */
	protected $target;

	/**
	 * getInstance
	 *
	 * @param string       $type
	 * @param \SplFileInfo $file
	 * @param string       $root
	 *
	 * @return AbstractFileProcessor
	 */
	public static function getInstance($type = 'twig', $file = null, $root = null, $folder)
	{
		$class = sprintf(__NAMESPACE__ . '\%sProcessor', ucfirst($type));

		if (!class_exists($class))
		{
			return new GeneralProcessor($file, $root, $folder);
		}

		return new $class($file, $root, $folder);
	}

	/**
	 * Class init.
	 *
	 * @param \SplFileInfo $file
	 * @param string       $root
	 * @param string       $folder
	 */
	public function __construct(\SplFileInfo $file, $root, $folder)
	{
		$this->file = $file;

		$this->data = new Data;

		if (!is_dir($root))
		{
			throw new \RuntimeException('Path: ' . $root . ' not exists.');
		}

		$this->root = realpath($root);
		$this->folder = $folder;

		$this->config = new Registry;
	}

	/**
	 * render
	 *
	 * @return  string
	 */
	abstract public function render();

	/**
	 * extractConfig
	 *
	 * @param string $template
	 *
	 * @return  string
	 */
	public function extractConfig($template)
	{
		$template = explode('---', $template, 2);

		try
		{
			$config = Yaml::parse($template[0]);

			if ($config)
			{
				array_shift($template);
			}

			$this->config->loadArray($config);
			$this->getData()->bind(array('config' => $config));

			// Target
			if ($this->config['permalink'])
			{
				$this->target = rtrim($this->config['permalink'], '/') . '.html';
			}
			else
			{
				$this->target = $this->getTarget();
			}

			return implode('---', $template);
		}
		catch (ParseException $e)
		{
			return implode('---', $template);
		}
	}

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
	 * __get
	 *
	 * @param string $name
	 *
	 * @return  Registry
	 */
	public function __get($name)
	{
		if ($name == 'config')
		{
			return $this->config;
		}

		return null;
	}

	/**
	 * Method to get property Target
	 *
	 * @return  string
	 */
	public function getTarget()
	{
		if (!$this->target)
		{
			$this->target = rtrim($this->getFolder(), '\\/') . DIRECTORY_SEPARATOR . ltrim($this->getLayout(), '\\/');
		}

		return $this->target;
	}

	/**
	 * Method to set property target
	 *
	 * @param   string $target
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setTarget($target)
	{
		$this->target = $target;

		return $this;
	}

	/**
	 * Method to get property Folder
	 *
	 * @return  string
	 */
	public function getFolder()
	{
		return $this->folder;
	}

	/**
	 * Method to set property folder
	 *
	 * @param   string $folder
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setFolder($folder)
	{
		$this->folder = $folder;

		return $this;
	}
}
