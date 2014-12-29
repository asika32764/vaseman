<?php
/**
 * Part of Vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Plugin;

use Windwalker\Event\Event;
use Windwalker\Registry\Registry;

/**
 * The MenuPlugin class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class MenuPlugin extends AbstractPlugin implements DataProviderInterface
{
	/**
	 * loadProvider
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function loadProvider(Event $event)
	{
		$menus = new Registry;
		$menus->loadFile(__DIR__ . '/menus.yml', 'yaml');

		$event['data']->menus = $menus->toArray();
	}
}
