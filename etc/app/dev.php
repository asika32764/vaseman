<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Windwalker\Utilities\ArrayHelper;

/*
 * Windwalker Web Dev Config
 * -------------------------------------
 * Things you config here will be used in web environment with dev mode.
 */
return ArrayHelper::merge(include __DIR__ . '/web.php', [
	/*
	 * Package Registration
	 * -------------------------------------
	 * Register new packages to Application. The key ia package name (alias).
	 *
	 * You can use `PackageHelper::getPackage('foo')` to get the packages
	 * you registered here.
	 */
	'packages' => [
		'_debugger' => \Windwalker\Debugger\DebuggerPackage::class
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
		// Add pretty error handler page.
		'whoops' => \Windwalker\Core\Provider\WhoopsProvider::class,
	],

	/*
	 * Register Routing Files
	 * -------------------------------------
	 * If you have more routing files, please add them here. You can also override
	 * core routing files, use same key name to override it.
	 */
	'routing' => [
		'files' => [
			'dev' => WINDWALKER_ETC . '/dev/routing.yml'
		]
	],

	/*
	 * Http Middlewares
	 * -------------------------------------
	 * Register middlewares to Application, these middleware will execute one by one
	 * and wrap the core process that you can add your logic before and after main
	 * execution code.
	 *
	 * Use numeric key name to control the execution ordering, the biggest number will
	 * execute first, and the smaller number will nearer to core logic.
	 *
	 * Uncomment the line below to override core middlewares.
	 */
	'middlewares' => [
		// Add something here...
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
		// Add dev config
		200 => WINDWALKER_ETC . '/dev/config.yml'
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
		// Add something here...
	],

	/*
	 * Register Error Handler Classes
	 */
	'error' => [
		'handlers' => [
			// Uncommnet this line if you need error log support
			// 'log' => \Windwalker\Core\Error\Handler\ErrorLogHandler::class
		]
	],

	/*
	 * Register User Auth Handlers
	 */
	'user' => [
		'handler' => \Windwalker\Core\User\NullUserHandler::class,
		'methods' => [
		],
		'policies' => [
		]
	]
]);