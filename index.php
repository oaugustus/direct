<?php
require_once __DIR__.'/lib/Direct/ClassLoader.php';

// define application directories constants
define("APP_PATH",__DIR__);
define("CONFIG_PATH",__DIR__.'/config');
define("CACHE_PATH",__DIR__.'/cache');

use Direct\ClassLoader;
$loader = new ClassLoader();

// register the namespaces to exposes to ClassLoader
$loader->registerNamespaces(array(
    'Direct' => __DIR__.'/lib',
    'Symfony' => __DIR__.'/lib',
    'actions' => __DIR__,
    'models' => __DIR__
));

// register PEAR like naming convention
$loader->registerPrefixes(array(
   'sfYaml' => __DIR__.'/lib/sfYaml'
));

$loader->register();

use Direct\Config;

// load development enviroment configs
Config::load('dev');

use Direct\Router;
// route the request
$router = new Router();
$router->route();