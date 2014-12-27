<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Web;

use Windwalker\Registry\Registry;

/**
 * The DevApplication class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DevApplication extends Application
{
	/**
	 * Property mode.
	 *
	 * @var  string
	 */
	public $mode = 'dev';

	/**
	 * loadConfiguration
	 *
	 * @param Registry $config
	 *
	 * @return  void
	 */
	protected function loadConfiguration(Registry $config)
	{
		parent::loadConfiguration($config);

		$config->loadFile(WINDWALKER_ETC . '/dev/config.yml', 'yaml');
	}
}
