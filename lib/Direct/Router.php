<?php

namespace Direct;
/**
 * Router class that route the client's request.
 * 
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Router
{
    /**
     * Instance of ExtDirect API.
     * 
     * @var API
     */
    public $api = null;
    
    public function __construct()
    {
        $this->api = new Api();
    }
    
    /**
     * Proccess the route of request.
     */
    public function route()
    {
        
    }
}
