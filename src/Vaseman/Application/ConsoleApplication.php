<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Application;

use Vaseman\Command\InitCommand;
use Windwalker\Console\Application;
use Windwalker\Environment\Environment;

/**
 * The ConsoleApplication class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ConsoleApplication extends Application
{
	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->set('outer_project', true);

		parent::initialise();

		$env = new Environment;

		$root = $env->server->getWorkingDirectory();

		$this->set('project.path.root', $root);
		$this->set('project.path.data', $root . '/.vaseman');
	}

	/**
	 * registerCommands
	 *
	 * @return  void
	 */
	public function registerCommands()
	{
		parent::registerCommands();

		$this->addCommand(new InitCommand);
	}

	/**
	 * loadConfiguration
	 *
	 * @param \Windwalker\Registry\Registry $config
	 *
	 * @return  void
	 */
	protected function loadConfiguration($config)
	{
		$config->loadFile($this->get('project.path.root') . '/.vaseman/config.yml', 'yaml');
	}
}
