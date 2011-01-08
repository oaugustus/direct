<?php

namespace Direct;

use \Symfony\Component\Finder\Finder;
/**
 * API class that generate JS ExtDirect API.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Api
{
    /**
     * Define the ExtDirect API resource name.
     * 
     * @var string
     */
    private $resourceName = null;

    /**
     * Cache file of ExtDirect API.
     * 
     * @var string
     */
    private $cacheFile = null;

    /**
     * Store the API collected in the actions.
     * 
     * @var array
     */
    private $api = null;

    /**
     * Type of ExtDirect Api.
     * 
     * @var string
     */
    private $type = null;

    /**
     * URL of Router route.
     * 
     * @var string
     */
    private $routerUrl = '/';


    /**
     * Name of JS variable that will take de ExtDirect API.
     * 
     * @var string
     */
    private $varName = 'Ext.app.REMOTING_API';
    
    public function __construct()
    {
        // initialize the private api properties
        $this->initialize();
        
        // if application is in debug mode
        if (Config::get('app.debug'))
        {
            // force generation of API based on actions classes
            $this->api = $this->createApi();
        }
        else
        {
            // load the direct api in cache file
            if (!file_exists(CACHE_PATH.'/'.$this->cacheFile))
            {
                // force generation of the API and generate the cache file
                $this->api = $this->createApi();
                $this->writeCache($this->api);
            }
            else
            {
                // load the api based on the cache file
                $this->api = json_decode($this->readCache());
            }
        }
    }

    /**
     * Initialize the api private properties.
     */
    private function initialize()
    {
        $this->resourceName = Config::get('app.api.resource');
        $this->cacheFile = Config::get('app.api.cache');
        $this->type = Config::get('app.api.type');
        $this->varName = Config::get('app.api.variable');
        $this->routerUrl = Config::get('app.api.url');
    }

    /**
     * Return the api resource name.
     * 
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * Read and return the content of the API cache file.
     *
     * @return json
     */
    private function readCache()
    {
        return file_get_contents(CACHE_PATH.'/'.$this->cacheFile);
    }

    /**
     * Write the content of api property in cache file.
     *
     * @param string $api
     */
    private function writeCache($api)
    {
        file_put_contents(CACHE_PATH.'/'.$this->cacheFile, json_encode($api));
    }


    /**
     * Create the ExtDirect api based on Actions.
     * 
     * @return array
     */
    private function createApi()
    {
        $api = array();
        $finder = new Finder();
        $finder->files()->in(ACTION_PATH);
        $finder->files()->name('*.php');

        foreach ($finder as $file)
        {
            $actionName = $this->getAction($file->getRealpath());
            $action = new ReflectionAction($actionName);
            $aApi = $action->getApi();

            if ($aApi)
                $api[$this->getActionIndex($actionName)] = $aApi;
        }

        return $api;
    }

    /**
     * Get an array index to full qualified action namespace.
     * 
     * @param string $action
     * @return string
     */
    private function getActionIndex($action)
    {
        return str_replace('.actions.','',str_replace('\\', '.', $action));
    }
    
    /**
     * Return full action qualified namespace.
     * 
     * @param  string $full_path
     * @return string 
     */
    private function getAction($full_path)
    {
        return str_replace('.php','',str_replace(APP_PATH, '', $full_path));
    }
    
    /**
     * Generate a JS ExtDirect API
     */
    public function __toString()
    {
        $api['url'] = $this->routerUrl;
        $api['type'] = $this->type;
        $api['actions'] = $this->api;
        
        return $this->varName." = ".json_encode($api);
    }
}