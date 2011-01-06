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
     * Return the api resource name.
     * 
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }
}