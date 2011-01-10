<?php

require_once __DIR__.'/lib/vendor/Direct/Kernel.php';

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
     * Register the framework and application constants.
     * 
     * Example of contant register:
     *   define("UPLOAD_PATH",$this->appPath."/upload");
     */
    public function  registerConstants()
    {
        parent::registerConstants();
    }
    
    /**
     * Register the application libraries
     *
     * Example library register:
     *   * PHP 5.3 naming convention library:
     *     $this->loader->registerNamespaces(array(
     *           'Doctrine' => $this->appPath.'/lib'
     *     );
     * 
     *   * PEAR naming convention library:
     *     $this->loader->registerPrefixes(array(
     *        'sfYaml' => $this->appPath.'/lib/sfYaml'
     *     );
     */
    public function  registerLibraries()
    {
        
    }

    /**
     * Setup the development enviroment configs.
     *
     * Example of config load:
     *   Config::load('level1','level2','level3');
     */
    public function  setupDev()
    {
        Config::load('direct','app','dev');
    }

    /**
     * Setup the production enviroment configs.
     *
     * Example of config load:
     *   Config::load('level1','level2','level3');
     */
    public function  setupProduction()
    {
        
    }

    /**
     * Setup the test enviroment configs.
     *
     * Example of config load:
     *   Config::load('level1','level2','level3');
     */
    public function  setupTest()
    {
    
    }
}
