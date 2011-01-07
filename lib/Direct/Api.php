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

    public function __construct()
    {
        // if application is in debug mode
        if (Config::get('app.debug'))
        {
            // forces the generation of API based on actions classes
        }
        else
        {
            // load the direct api in cache file
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
     * Generate a JS ExtDirect API
     */
    public function __toString()
    {
        
    }
}