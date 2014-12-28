<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Command;

use Windwalker\Console\Command\Command;
use Windwalker\Environment\Environment;
use Windwalker\Filesystem\Exception\FilesystemException;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Folder;

/**
 * The InitCommand class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class InitCommand extends Command
{
	/**
	 * Property isEnabled.
	 *
	 * @var  boolean
	 */
	public static $isEnabled = true;

	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'init';

	/**
	 * Property description.
	 *
	 * @var  string
	 */
	protected $description = 'Initialise a site project.';

	/**
	 * Property usage.
	 *
	 * @var  string
	 */
	protected $usage = 'up <cmd><command></cmd> <option>[options]</option>';

	/**
	 * doExecute
	 *
	 * @return  integer
	 */
	protected function doExecute()
	{
		$projectRoot = $this->app->get('project.path.data');

		$systemRoot = WINDWALKER_ROOT;

		$this->copyFolder($systemRoot . '/media', $projectRoot . '/media');
		$this->copyFolder($systemRoot . '/entries', $projectRoot . '/entries');
		$this->copyFolder($systemRoot . '/layouts', $projectRoot . '/layouts');
		$this->copyFile($systemRoot . '/etc/config.yml', $projectRoot . '/config.yml');

		$this->createFolder($projectRoot . '/plugins');

		return true;
	}

	/**
	 * copy
	 *
	 * @param string $src
	 * @param string $dest
	 *
	 * @return  void
	 */
	protected function copyFolder($src, $dest)
	{
		$this->out('Create: ' . $dest);

		if (is_dir($dest))
		{
			Folder::delete($dest);
		}

		Folder::copy($src, $dest);
	}

	/**
	 * copy
	 *
	 * @param string $src
	 * @param string $dest
	 *
	 * @return  void
	 */
	protected function copyFile($src, $dest)
	{
		$this->out('Create: ' . $dest);

		if (is_file($dest))
		{
			File::delete($dest);
		}

		File::copy($src, $dest);
	}

	/**
	 * createFolder
	 *
	 * @param string $dest
	 *
	 * @return  void
	 */
	protected function createFolder($dest)
	{
		$this->out('Create: ' . $dest);

		Folder::create($dest);

		File::write($dest . '/.gitkeep', '');
	}
}
