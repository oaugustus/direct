<?php

require_once __DIR__.'/lib/Direct/Kernel.php';

use Direct\Kernel;
use Direct\Config;

/**
 * Application Kernel class that provide the framework internals.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class AppKernel extends Kernel
{
    protected $env = 'dev';

    /**
     * Define the app path
     */
    public function __construct()
    {
        parent::__construct();
        $this->appPath = __DIR__;
    }
    
    /**
     * Register the framework and application constants
     */
    public function  registerConstants()
    {
        define("APP_PATH",__DIR__);
        define("ACTION_PATH",__DIR__.'/actions');
        define("CONFIG_PATH",__DIR__.'/config');
        define("CACHE_PATH",__DIR__.'/cache');
        define("MODEL_PATH",__DIR__.'/models');
        define("VIEW_PATH",__DIR__.'/views');        
    }
    
    /**
     * Register the application libraries
     */
    public function  registerLibraries()
    {
        
    }

    /**
     * Setup the development enviroment configs.
     */
    public function  setupDev()
    {
        Config::load('direct','app','dev');
    }

    /**
     * Setup the production enviroment configs.
     */
    public function  setupProduction()
    {
        
    }

    /**
     * Setup the test enviroment configs.
     */
    public function  setupTest()
    {
    
    }
}
