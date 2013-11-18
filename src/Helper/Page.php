<?php

namespace Helper;

use DI\BaseHelper as Helper;

class Page extends Helper
{
	public function getPageName()
	{
		$path = $this->helper->data->path;

		$last = array_pop($path);

		if ($last != 'index')
		{
			
		}

		return $this->databases;
	}
}
