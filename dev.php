<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

// Start composer
$root = __DIR__;

if (!is_file($root . '/vendor/autoload.php'))
{
	exit('Please run `composer install` First.');
}

include_once $root . '/vendor/autoload.php';
include_once $root . '/etc/define.php';

$config = new \Windwalker\Structure\Structure;

if (is_file(WINDWALKER_ETC . '/secret.yml'))
{
	$config->loadFile(WINDWALKER_ETC . '/secret.yml');
}

// Get allow remote ips from config.
if (isset($_SERVER['HTTP_CLIENT_IP']) || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
	|| !(in_array(@$_SERVER['REMOTE_ADDR'], (array) $config->get('dev.allow_ips', ['127.0.0.1', '::1', 'fe80::1']))))
{
	header('HTTP/1.1 403 Forbidden');

	exit('Forbidden');
}

// Start our application.
$app = new Windwalker\Web\DevApplication;

define('WINDWALKER_DEBUG', $app->get('system.debug'));

$app->execute();
