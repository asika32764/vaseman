<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

$autoload = __DIR__ . '/../vendor/autoload.php';

if (!is_file($autoload))
{
	exit('Please run <code>$ composer install</code> First.');
}

include_once $autoload;

$_SERVER['HTTP_HOST'] = 'windwalker.io';

include_once __DIR__ . '/../etc/define.php';

new \Vaseman\Test\TestApplication;

define('WINDWALKER_DEBUG', true);

