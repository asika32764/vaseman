<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

/*
 * Windwalker Core Config
 * -------------------------------------
 * Things you config here will be used in both web and console environment.
 */
return [
	/*
	 * Package Registration
	 * -------------------------------------
	 * Register new packages to Application. The key ia package name (alias).
	 * 
	 * You can use `PackageHelper::getPackage('foo')` to get the packages
	 * you registered here.
	 */
	'packages' => [
		'vaseman' => \Vaseman\VasemanPackage::class
	],

	/*
	 * Provider Registration
	 * -------------------------------------
	 * Register DI service providers to Container.
	 * 
	 * If you installed 3rd packages from composer, you may add them to here.
	 * The packages you want to register into Container must provides a Windwalker
	 * service provider interface.
	 * 
	 * You can override the default providers in Windwalker core. Just uncomment
	 * the line, use same key name and replace provider class by your own.
	 *
	 * NOTE: You must familiar about how DI Container working, otherwise you may
	 *       break your system.
	 */
	'providers' =>[
		//'logger' => \Windwalker\Core\Provider\LoggerProvider::class,
		//'event'  => \Windwalker\Core\Provider\EventProvider::class,
		//'mailer' => \Windwalker\Core\Mailer\MailerProvider::class,
		//'mailer_adapter' => \Windwalker\Core\Mailer\SwiftMailerProvider::class
	],

	/*
	 * Load Config Files
	 * -------------------------------------
	 * Add extra config file that you can customize your application by more settings.
	 *
	 * Use numeric key name to make sure configs has correct ordering to load.
	 * The bigger number will load later and override the previous, so `stc/secret.yml`
	 * will be the latest file and override all configs.
	 */
	'configs' => [
		100 => WINDWALKER_ETC . '/config.php',
		800 => WINDWALKER_ETC . '/secret.yml',
	],

	/*
	 * Event Listeners
	 * -------------------------------------
	 * Add event listeners to event Dispatcher, this function help us inject logic between
	 * every checkpoint when system running.
	 *
	 * You can add a class name by `'foo' => \Namespace\MyListener::class` or new an object.
	 * We also support callable, use `'onEventName' => ['Class', 'method]` to add callback.
	 *
	 * If you want to add priority to control the execution ordering of listeners, use array to config it.
	 * Example: 'foo' => ['class' => MyListener::class, 'priority' => 300, 'enabled' => boolean]
	 */
	'listeners' => [
		'vaseman' => \Vaseman\Listener\VasemanListener::class
	],

	/*
	 * Register DI Container Aliases
	 * -------------------------------------
	 * If you must override some core classes by your own, replace the target class here.
	 */
	'di' => [
		'aliases' => [
			// System
			'application' => \Windwalker\Core\Application\WindwalkerApplicationInterface::class,
			'app'         => \Windwalker\Core\Application\WindwalkerApplicationInterface::class,
			'config'      => \Windwalker\Core\Config\Config::class,
			'package.resolver' => \Windwalker\Core\Package\PackageResolver::class,

			// Web
			'input'       => \Windwalker\IO\Input::class,
			'environment' => \Windwalker\Environment\WebEnvironment::class,
			'browser'     => \Windwalker\Environment\Browser\Browser::class,
			'platform'    => \Windwalker\Environment\Platform::class,
			'uri'         => \Windwalker\Uri\UriData::class,

			// Error
			'error.handler' => \Windwalker\Core\Error\ErrorManager::class,

			// Logger
			'logger' => \Windwalker\Core\Logger\LoggerManager::class,

			// Event
			'dispatcher' => \Windwalker\Core\Event\EventDispatcher::class,

			// Database
			'database'     => \Windwalker\Database\Driver\AbstractDatabaseDriver::class,
			'db'           => \Windwalker\Database\Driver\AbstractDatabaseDriver::class,
			'sql.exporter' => \Windwalker\Core\Database\Exporter\AbstractExporter::class,

			// Router
			'router' => \Windwalker\Core\Router\MainRouter::class,

			// Language
			'language' => \Windwalker\Core\Language\CoreLanguage::class,

			// Renderer
			'renderer.manager' => \Windwalker\Core\Renderer\RendererManager::class,
			'renderer'         => \Windwalker\Core\Renderer\RendererManager::class,
			'package.finder'   => \Windwalker\Core\Renderer\Finder\PackageFinder::class,
			'widget.manager'   => \Windwalker\Core\Widget\WidgetManager::class,

			// Cache
			'cache.manager' => \Windwalker\Core\Cache\CacheManager::class,
			'cache'         => \Windwalker\Cache\Cache::class,

			// Session
			'session' => \Windwalker\Session\Session::class,

			// User
			'authentication' => \Windwalker\Authentication\AuthenticationInterface::class,
			'authorisation'  => \Windwalker\Authorisation\AuthorisationInterface::class,
			'user.manager'   => \Windwalker\Core\User\UserManager::class,

			// Security
			'security.csrf' => \Windwalker\Core\Security\CsrfGuard::class,
			'crypt' => \Windwalker\Crypt\Crypt::class,

			// DateTime
			'datetime' => \Windwalker\Core\DateTime\DateTime::class,

			// Asset
			'asset' => \Windwalker\Core\Asset\AssetManager::class,
			'script.manager' => \Windwalker\Core\Asset\ScriptManager::class,

			// Mailer
			'mailer' => \Windwalker\Core\Mailer\MailerManager::class
		]
	],

	/*
	 * Path Define
	 * -------------------------------------
	 * These paths make our core library works correctly.
	 */
	'path' => [
		'root'       => WINDWALKER_ROOT,
		'bin'        => WINDWALKER_BIN,
		'cache'      => WINDWALKER_CACHE,
		'etc'        => WINDWALKER_ETC,
		'logs'       => WINDWALKER_LOGS,
		'resources'  => WINDWALKER_RESOURCES,
		'source'     => WINDWALKER_SOURCE,
		'temp'       => WINDWALKER_TEMP,
		'templates'  => WINDWALKER_TEMPLATES,
		'vendor'     => WINDWALKER_VENDOR,
		'public'     => WINDWALKER_PUBLIC,
		'migrations' => WINDWALKER_MIGRATIONS,
		'seeders'    => WINDWALKER_SEEDERS,
		'languages'  => WINDWALKER_LANGUAGES,
	]
];
