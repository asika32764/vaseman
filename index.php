<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

$root = __DIR__;

if (!is_file($root . '/vendor/autoload.php'))
{
	exit('Please run `composer install` First.');
}

include_once $root . '/vendor/autoload.php';
include_once $root . '/etc/define.php';

$app = new \Windwalker\Web\Application;

define('WINDWALKER_DEBUG', $app->get('system.debug'));

$app->execute();
