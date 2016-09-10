<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\Console;

use Windwalker\Core\Console\CoreConsole;
use Windwalker\Core\Provider;
use Windwalker\Debugger\Helper\ComposerInformation;
use Windwalker\VasemanTrait;

/**
 * The WindwalkerConsole class.
 * 
 * @since  2.1.1
 */
class Application extends CoreConsole
{
	use VasemanTrait;

	/**
	 * Property title.
	 *
	 * @var  string
	 */
	protected $title = 'Vaseman';

	/**
	 * Property configPath.
	 *
	 * @var  string
	 */
	protected $rootPath = WINDWALKER_ROOT;

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function init()
	{
		parent::init();

		$this->version = 3;
	}

	/**
	 * registerCommands
	 *
	 * @return  void
	 */
	public function registerCommands()
	{
		parent::registerCommands();

		/*
		 * Register Commands
		 * --------------------------------------------
		 * Register your own commands here, make sure you have call the parent, some important
		 * system command has registered at parent::registerCommands().
		 */

		// Your commands here.
	}

	/**
	 * Prepare execute hook.
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		parent::prepareExecute();
	}

	/**
	 * Pose execute hook.
	 *
	 * @param   mixed  $result  Executed return value.
	 *
	 * @return  mixed
	 */
	protected function postExecute($result = null)
	{
		return $result;
	}
}
