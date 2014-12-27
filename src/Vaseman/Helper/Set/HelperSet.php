<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Helper\Set;

use Windwalker\Core\View\Helper\AbstractHelper;

/**
 * The HelperSet class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class HelperSet extends \Windwalker\Core\View\Helper\Set\HelperSet
{
	/**
	 * __get
	 *
	 * @param string $name
	 *
	 * @return AbstractHelper
	 */
	public function __get($name)
	{
		if (empty(static::$helpers[$name]))
		{
			$class = 'Vaseman\Helper\\' . ucfirst($name) . 'Helper';

			if (!class_exists($class))
			{
				return false;
			}

			static::$helpers[$name] = new $class($this);
		}

		return static::$helpers[$name];
	}
}
