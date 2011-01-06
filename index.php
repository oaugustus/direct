<?php

require_once __DIR__.'/app/lib/Direct/ClassLoader.php';

use Direct\ClassLoader;

$loader = new ClassLoader();
$loader->registerNamespaces(array(
    'Direct' => __DIR__.'/lib'
));