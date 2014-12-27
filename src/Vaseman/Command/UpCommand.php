<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Command;

use Vaseman\Entry\Entry;
use Vaseman\Entry\Page;
use Vaseman\Model\PageModel;
use Vaseman\View\Page\PageHtmlView;
use Windwalker\Console\Command\Command;
use Windwalker\Core\Error\ErrorHandler;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\Core\Utilities\DateTimeHelper;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Filesystem;
use Windwalker\Filesystem\Folder;
use Windwalker\Utilities\Queue\Priority;

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
			->defaultValue('output')
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

		$files = Folder::files(WINDWALKER_ENTRIES, true, Folder::PATH_RELATIVE);

		$entries = array();

		/** @var \SplFileInfo $entry */
		foreach ($files as $file)
		{
			$entries[] = new Entry($file, WINDWALKER_ENTRIES);
		}

		$view = new PageHtmlView;
		$view->setPackage(PackageHelper::getPackage('vaseman'));

		$view->addPath($this->app->get('project.path.data'), Priority::HIGH);
		$view->addPath($this->app->get('project.path.root'), Priority::NORMAL);

		$pages = array();

		foreach ($entries as $entry)
		{
			$layout = File::stripExtension($entry->getPath());

			$html = $view->setLayout($layout)->render();

			$pages[] = new Page($layout . '.html', $html);
		}

		$dir = $this->getOption('dir');

		$dir = WINDWALKER_ROOT . '/' . ltrim($dir. '/');

		foreach ($pages as $page)
		{
			$file = $dir . '/' . $page->getFile();

			$this->out('Write file: ' . $file);

			Folder::create(dirname($file));

			file_put_contents($dir . '/' . ltrim($page->getFile(), '/'), $page->getData());
		}

		return 0;
	}
}
