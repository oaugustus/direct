<?php
require_once __DIR__.'/lib/Direct/ClassLoader.php';

use Direct\ClassLoader;
$loader = new ClassLoader();

// register the namespaces to exposes to ClassLoader
$loader->registerNamespaces(array(
    'Direct' => __DIR__.'/lib',
    'actions' => __DIR__,
    'models' => __DIR__
));

// register PEAR like naming convention
$loader->registerPrefixes(array(
   'sfYaml' => __DIR__.'/lib/sfYaml'
));

$loader->register();

use Direct\Router;
// route the request
$router = new Router();
$router->route();