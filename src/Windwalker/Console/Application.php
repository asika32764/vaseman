<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Console;

use Vaseman\Command\UpCommand;
use Windwalker\Core\Console\WindwalkerConsole;
use Windwalker\Core\Provider\CacheProvider;
use Windwalker\Core\Provider\DatabaseProvider;
use Windwalker\Core\Provider\EventProvider;
use Windwalker\Core\Provider\LanguageProvider;
use Windwalker\Core\Router\RestfulRouter;
use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Registry\Registry;
use Windwalker\User\UserPackage;
use Windwalker\Windwalker;

/**
 * The WindwalkerConsole class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Application extends WindwalkerConsole
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'Vaseman';

	/**
	 * Property version.
	 *
	 * @var  string
	 */
	protected $version = '2.0';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		Windwalker::prepareSystemPath($this->config);

		parent::initialise();

		$this->setHelp(<<<HELP
Welcome to Vaseman Console.
HELP
);

		$this->setDescription('Vaseman console system.');

		$this->container->set('system.router', new RestfulRouter);
	}

	/**
	 * loadProviders
	 *
	 * @return  ServiceProviderInterface[]
	 */
	public function loadProviders()
	{
		return array(
			/*
			 * Default Providers:
			 * -----------------------------------------
			 * This is some default service providers, we don't recommend to remove them,
			 * But you can replace with yours, Make sure all the needed container key has
			 * registered in your own providers.
			 */
			'event'    => new EventProvider,
			'database' => new DatabaseProvider,
			'lang'     => new LanguageProvider,
			'cache'    => new CacheProvider,

			/*
			 * Custom Providers:
			 * -----------------------------------------
			 * You can add your own providers here. If you installed a 3rd party packages from composer,
			 * but this package need some init logic, create a service provider to do this and register it here.
			 */

			// Custom Providers here...
		);
	}

	/**
	 * registerCommands
	 *
	 * @return  void
	 */
	public function registerCommands()
	{
		/*
		 * Register Commands
		 * --------------------------------------------
		 * Register your own commands here, make sure you have call the parent, some important
		 * system command has registered at parent::registerCommands().
		 */

		// Your commands here.
		$this->addCommand(new UpCommand);
	}

	/**
	 * getPackages
	 *
	 * @return  array
	 */
	public function loadPackages()
	{
		/*
		 * Get Global Packages
		 * -----------------------------------------
		 * If you want a package can be use in every applications (for example: Web and Console),
		 * set it in Windwalker\Windwalker object.
		 */
		$packages = Windwalker::loadPackages();

		/*
		 * Get Packages for This Application
		 * -----------------------------------------
		 * If you want a package only use in this application or want to override a global package,
		 * set it here. Example: $packages[] = new Flower\FlowerPackage;
		 */

		// Your packages here...

		return $packages;
	}

	/**
	 * Prepare execute hook.
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
	}

	/**
	 * Pose execute hook.
	 *
	 * @param   mixed  $result  Executed return value.
	 *
	 * @return  mixed
	 */
	protected function postExecute($result = null)
	{
		return $result;
	}

	/**
	 * loadConfiguration
	 *
	 * @param Registry $config
	 *
	 * @throws  \RuntimeException
	 * @return  void
	 */
	protected function loadConfiguration($config)
	{
		Windwalker::loadConfiguration($this->config);
	}
}
