<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\View;

use Windwalker\Data\Data;
use Windwalker\Event\Event;
use Windwalker\Ioc;

/**
 * The GlobalProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GlobalProvider
{
	/**
	 * Property data.
	 *
	 * @var  Data
	 */
	protected static $data;

	/**
	 * loadGlobalProvider
	 *
	 * @return  Data
	 */
	public static function loadGlobalProvider()
	{
		if (static::$data)
		{
			return static::$data;
		}

		$event = new Event('loadGlobalProvider');
		$event['data'] = new Data;

		Ioc::getDispatcher()->triggerEvent($event);

		return static::$data = $event['data'];
	}
}
