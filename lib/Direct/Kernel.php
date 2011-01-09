<?php

namespace Direct;

require_once __DIR__.'/ClassLoader.php';

/**
 * Abstrac Kernel class that provide the framework internals signature.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
abstract class Kernel
{
    /**
     * Define the path info of application.
     * 
     * @var string
     */
    protected $appPath = null;
    /**
     * Autoloader class.
     * 
     * @var \Direct\ClassLoader
     */
    protected $loader = null;

    /**
     * Router objetct. s
     * 
     * @var \Direct\Router
     */
    protected $router = null;

    /**
     * Define the config enviroment to load.
     * 
     * @var string
     */
    protected $env = 'dev';
    
    public function __construct()
    {
        $this->loader = new ClassLoader();
    }
    
    /**
     * Register the framework constants
     */
    abstract public function registerConstants();

    /**
     * Register the vendor libraries
     */
    abstract public function registerLibraries();

    /**
     * Setup the development enviroment.
     */
    abstract public function setupDev();

    /**
     * Setup the production enviroment.
     */
    abstract public function setupProduction();

    /**
     * Setup the test enviroment.
     */
    abstract public function setupTest();


    /**
     * Register the framework internals dependencies
     */
    public function  registerInternals()
    {
        // register the namespaces to exposes to ClassLoader
        $this->loader->registerNamespaces(array(
            'Direct' => $this->appPath.'/lib',
            'Symfony' => $this->appPath.'/lib',
            'actions' => $this->appPath,
            'models' => $this->appPath
        ));

        // register PEAR like naming convention
        $this->loader->registerPrefixes(array(
           'sfYaml' => $this->appPath.'/lib/sfYaml',
           'Twig' => $this->appPath.'/lib',
        ));
    }

    /**
     * Run the Direct application
     */
    public function run()
    {
        // register framework properties and configs
        $this->registerConstants();
        $this->registerInternals();
        $this->registerLibraries();
        $this->loader->register();
        
        // get the enviroment setup method
        $setupMethod = 'setup'.ucfirst($this->env);
        
        if (!method_exists($this, $setupMethod))
        {
            throw new \Exception('The setup'.$setupMethod.' method was not found!');
        }

        $this->$setupMethod();

        // route the request
        $this->router = new Router();
        $this->router->route();
    }
}
