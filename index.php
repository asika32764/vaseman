<?php

require 'vendor/autoload.php';

$config = require 'config.php';

$app = new \Slim\Slim($config);

$execute = function($path = array()) use($app)
{
    // Get assets path
    $base = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME'])) . '/';
    
    $template = implode('/', $path);
    
    $template = $template ?: 'index';

	$helper = new DI\Helper();
    
    $data = array(
        'path' => $path,
        'uri'  => array('base' => $base)
    );

	$helper->set('data', $data);

	$data['helper'] = $helper;
    
    $app->render($template, $data);
};

$app->get('/', $execute);

$app->get('/:path+', $execute);

$app->run();