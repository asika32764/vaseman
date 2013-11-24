<?php

namespace Helper;

use DI\BaseHelper as Helper;

class Page extends Helper
{
	public function getPageName($path)
	{
		$path = implode('.', $path);

		return $path;
	}

	public function getID($path)
	{
		$path = implode('-', $path);

		return $path;
	}

	public function getClass($path)
	{
		$path = implode(' ', $path);

		return $path;
	}

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
