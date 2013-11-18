<?php

define('PROTOTYPE_ROOT', __DIR__);

return array(
    'debug' => true,
    'mode' => 'development',
    'view' => new View\Page(),
    'templates.path' => __DIR__ . '/templates'
);