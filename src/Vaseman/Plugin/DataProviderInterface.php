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
 * The ContentPluginInterface class.
 * 
 * @since  {DEPLOY_VERSION}
 */
interface DataProviderInterface
{
	/**
	 * onContentPrepareData
	 *
	 * @param   Event  $event
	 *
	 * @return  void
	 */
	public function onContentPrepareData(Event $event);
}
