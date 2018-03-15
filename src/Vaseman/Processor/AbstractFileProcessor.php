<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Processor;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Vaseman\Exception\NoConfigException;
use Vaseman\Processor\Helper\ProcessorHelper;
use Windwalker\Data\Data;
use Windwalker\Event\Event;
use Windwalker\Ioc;
use Windwalker\Structure\Structure;

/**
 * The AbstractFileProcessor class.
 *
 * @property-read  Structure $config  Page config.
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
	 * @var Structure
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
	 * @param string       $folder
	 *
	 * @return AbstractFileProcessor
	 */
	public static function getInstance($type = 'twig', $file = null, $root = null, $folder = null)
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

		$this->root   = realpath($root);
		$this->folder = $folder;

		$this->config = new Structure;
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
	public function prepareData($template)
	{
		$template = explode('---', $template, 3);

		$config = null;

		// URI
		$uri = Ioc::get('view.data.uri');

		try
		{
			if (\count($template) !== 3)
			{
				throw new NoConfigException('No config');
			}

			$config = Yaml::parse($template[1]);

			if ($config)
			{
				array_shift($template);
				array_shift($template);
			}

			$this->config->load($config);
			$this->config->merge(Ioc::getConfig());
			$this->getData()->bind(array('config' => $this->config->toArray()));

			// Target permalink
			if ($this->config->get('permalink'))
			{
				$this->target = rtrim($this->config->get('permalink'), '/');

				if (substr($this->target, -5) != '.html')
				{
					$this->target .= '/index.html';
				}

				$uri['base']  = ProcessorHelper::getBackwards($this->target) ?: './';
				$uri['media'] = ProcessorHelper::getBackwards($this->target) . 'media/';
			}
			else
			{
				$this->target = $this->getTarget();
			}

			$template = implode('---', $template);
		}
		catch (ParseException $e)
		{
			$template = implode('---', $template);
		}
		catch (NoConfigException $e)
		{
			$template = implode('---', $template);
		}

		$this->data->uri  = $uri;
		$this->data->path = Ioc::get('view.data.path');

		$event              = new Event('loadProvider');
		$event['data']      = $this->data;
		$event['processor'] = $this;

		$dispatcher = Ioc::getDispatcher();
		$dispatcher->triggerEvent($event);

		return $template;
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
		return trim(str_replace($this->getRoot(), '', $this->file->getPathname()), '/\\');
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
	 * __get
	 *
	 * @param string $name
	 *
	 * @return  Structure
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
