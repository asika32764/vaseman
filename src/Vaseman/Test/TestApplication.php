<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Test;

use Windwalker\Web\Application;

/**
 * The TestApplication class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class TestApplication extends Application
{
	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		parent::initialise();

		$this->set('project.path.entries', __DIR__ . '/entries');
	}
}
