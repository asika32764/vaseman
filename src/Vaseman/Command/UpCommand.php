<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Command;

use Vaseman\Controller\Page\GetController;
use Vaseman\Asset\Asset;
use Vaseman\File\AbstractFileProcessor;
use Windwalker\Console\Command\Command;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\Core\Utilities\DateTimeHelper;
use Windwalker\Filesystem\Filesystem;
use Windwalker\Filesystem\Folder;
use Windwalker\Filesystem\Path;
use Windwalker\IO\Input;

/**
 * The UpCommand class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UpCommand extends Command
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
	protected $name = 'up';

	/**
	 * Property description.
	 *
	 * @var  string
	 */
	protected $description = 'Generate site.';

	/**
	 * Property usage.
	 *
	 * @var  string
	 */
	protected $usage = 'up <cmd><command></cmd> <option>[options]</option>';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->addOption('d')
			->alias('dir')
			->description('Directory to convert.');
	}

	/**
	 * doExecute
	 *
	 * @return  integer
	 */
	protected function doExecute()
	{
		DateTimeHelper::setDefaultTimezone();

		$this->out()->out('Vaseman generator')
			->out('-----------------------------')->out()
			->out('<comment>Start generating site</comment>')->out();

		$dataRoot = $this->app->get('project.path.data', WINDWALKER_ROOT);

		$folders = $this->app->get('folders', array());

		$controller = new GetController();

		$controller->setPackage(PackageHelper::getPackage('vaseman'));
		$controller->setApplication($this->app);

		$assets = array();
		$processors = array();

		foreach ($folders as $folder)
		{
			$files = Filesystem::files($dataRoot . '/' . $folder, true);

			foreach ($files as $file)
			{
				$asset = new Asset($file, $dataRoot . '/' . $folder);

				$layout = Path::clean($asset->getPath(), '/');

				$input = new Input(array('paths' => explode('/', $layout)));

				$config = $controller->getConfig();
				$config->set('layout.path', $asset->getRoot());
				$config->set('layout.folder', $folder);

				$controller->setInput($input)->execute();

				$processors[] = $controller->getProcessor();
			}
		}

		$dir = $this->getOption('dir');

		$dir = $dir ? : $this->app->get('outer_project') ? "" : 'output';

		$dir = $this->app->get('project.path.root') . '/' . $dir;

		/** @var AbstractFileProcessor $processor */
		foreach ($processors as $processor)
		{
			$file = Path::clean($dir . '/' . $processor->getTarget());

			$this->out('<info>Write file</info>: ' . $file);

			Folder::create(dirname($file));

			file_put_contents($file, $processor->getOutput());
		}

		$this->out()->out('<info>Complete</info>')->out();

		return 0;
	}
}
