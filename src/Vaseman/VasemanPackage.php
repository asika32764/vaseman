<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman;

use Windwalker\Console\Console;
use Windwalker\Core\Package\AbstractPackage;

/**
 * The VasemanPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class VasemanPackage extends AbstractPackage
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'vaseman';

	/**
	 * registerCommands
	 *
	 * @param Console $console
	 *
	 * @return  void
	 */
	public static function registerCommands(Console $console)
	{
	}
}
