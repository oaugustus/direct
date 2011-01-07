<?php
require_once __DIR__.'/lib/Direct/ClassLoader.php';

// define application directories constants
define("APP_PATH",__DIR__);
define("CONFIG_PATH",__DIR__.'/config');

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

// initialize application configs
use Direct\Config;
Config::initialize();

use Direct\Router;
// route the request
$router = new Router();
$router->route();