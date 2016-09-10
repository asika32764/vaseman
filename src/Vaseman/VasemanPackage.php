<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman;

use Vaseman\Twig\VasemanTwigExtension;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Event\DispatcherInterface;
use Windwalker\Ioc;
use Windwalker\Loader\ClassLoader;
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
	public function boot()
	{
		// A workaround before Windwalker Loader fix bug
//		class_alias('Windwalker\Loader\Loader\VasemanPsr4Loader', 'Windwalker\Loader\Loader\Psr4Loader');

		parent::boot();

		GlobalContainer::addExtension('vaseman', new VasemanTwigExtension);
	}

	/**
	 * registerListeners
	 *
	 * @param DispatcherInterface $dispatcher
	 *
	 * @return  void
	 */
	public function registerListeners(DispatcherInterface $dispatcher)
	{
		$config = Ioc::getConfig();
	}
}
