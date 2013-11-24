<?php

namespace Console\Helper;

abstract class CommandHelper
{
	static public function loadFirstLevelCommnads($console)
	{
		$dir = dirname(__DIR__) . '/Command';

		$files = new \FilesystemIterator($dir);

		foreach ($files as $file)
		{
			/** @var $file \SplFileInfo */
			if ($file->isFile())
			{
				continue;
			}

			$class = 'Console\\Command\\' . $file->getBasename() . '\\' . $file->getBasename();

			if (class_exists($class))
			{
				$console->addCommand(new $class);
			}
		}
	}
}
