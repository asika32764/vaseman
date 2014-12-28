<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman;

use Vaseman\Twig\VasemanTwigExtension;
use Windwalker\Console\Console;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Renderer\Twig\GlobalContainer;

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
	 * initialise
	 *
	 * @return  void
	 */
	public function initialise()
	{
		parent::initialise();

		GlobalContainer::addExtension('vaseman', new VasemanTwigExtension);
	}

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
