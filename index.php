<?php

require_once __DIR__.'/lib/Direct/ClassLoader.php';

use Direct\ClassLoader;
$loader = new ClassLoader();

// register the namespaces to exposes to ClassLoader
$loader->registerNamespaces(array(
    'Direct' => __DIR__.'/lib'
));
$loader->register();


use Direct\Router;

// route the request
$router = new Router();
$router->route();