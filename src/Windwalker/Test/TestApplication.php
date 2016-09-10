<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\Test;

use Windwalker\Session\Test\Mock\MockArrayBridge;
use Windwalker\Web\Application;

/**
 * The TestApplication class.
 * 
 * @since  2.1.1
 */
class TestApplication extends Application
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'test';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function init()
	{
		parent::init();

		$this->boot();

		$session = $this->session;
		$session->setBridge(new MockArrayBridge);
	}
}
