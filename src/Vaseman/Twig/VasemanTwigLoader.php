<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Twig;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Vaseman\Processor\TwigProcessor;

/**
 * The VasemanTwigLoader class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class VasemanTwigLoader extends \Twig_Loader_Filesystem
{
	/**
	 * Property env.
	 *
	 * @var  \Twig_Environment
	 */
	protected $env;

	/**
	 * Property processor.
	 *
	 * @var  TwigProcessor
	 */
	protected $processor;

	/**
	 * Class init
	 *
	 * @param array $paths
	 */
	public function __construct($paths = array())
	{
		parent::__construct($paths);
	}

	/**
	 * getSource
	 *
	 * @param string $name
	 *
	 * @return  string
	 */
	public function getSource($name)
	{
		$template = parent::getSource($name);

		return $this->processor->prepareData($template);
	}

	/**
	 * Method to get property Env
	 *
	 * @return  \Twig_Environment
	 */
	public function getEnv()
	{
		return $this->env;
	}

	/**
	 * Method to set property env
	 *
	 * @param   \Twig_Environment $env
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setEnv($env)
	{
		$this->env = $env;

		return $this;
	}

	/**
	 * Method to get property Processor
	 *
	 * @return  TwigProcessor
	 */
	public function getProcessor()
	{
		return $this->processor;
	}

	/**
	 * Method to set property processor
	 *
	 * @param   TwigProcessor $processor
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setProcessor($processor)
	{
		$this->processor = $processor;

		return $this;
	}
}
