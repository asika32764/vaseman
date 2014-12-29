<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Plugin;

use Windwalker\Event\Event;

/**
 * Interface ExtensionProviderInterface
 *
 * @since  {DEPLOY_VERSION}
 */
interface ExtensionProviderInterface
{
	/**
	 * loadExtension
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function loadExtensions(Event $event);
}
