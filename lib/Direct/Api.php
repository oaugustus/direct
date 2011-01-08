<?php

namespace Direct;
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
    private $resourceName = 'api.js';

    /**
     * Cache file of ExtDirect API.
     * 
     * @var string
     */
    private $cacheFile = 'api.json';

    /**
     * Store the API collected in the actions.
     * 
     * @var array
     */
    private $api = null;

    public function __construct()
    {
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
     * Generate a JS ExtDirect API
     */
    public function __toString()
    {
        
    }
}