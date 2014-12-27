<?php
/**
 * Part of the Vaseman Prototype System files.
 *
 * @copyright  Copyright (C) 2013 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Vaseman\Helper;

use Windwalker\Core\View\Helper\AbstractHelper;

/**
 * Class Page
 *
 * @package Helper
 */
class PageHelper extends AbstractHelper
{
	/**
	 * getPageName
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public function getPageName($path)
	{
		$path = implode('.', $path);

		return $path;
	}

	/**
	 * getID
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public function getID($path)
	{
		$path = implode('-', $path);

		return $path;
	}

	/**
	 * getClass
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public function getClass($path)
	{
		$path = implode(' ', $path);

		return $path;
	}

	/**
	 * isActive
	 *
	 * @param $path
	 * @param $key
	 *
	 * @return string
	 */
	public function isActive($path, $key)
	{
		$path = implode('.', $path);

		if (strpos($path, $key) !== false)
		{
			return 'active';
		}

		return '';
	}
}
