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
			if ($file->isDir())
			{
				continue;
			}

			$class = 'Console\\Command\\' . $file->getBasename('.php');

			if (class_exists($class))
			{
				$console->addCommand(new $class);
			}
		}
	}
}
