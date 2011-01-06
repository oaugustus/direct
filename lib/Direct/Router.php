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
     * @var Api
     */
    private $api = null;

    /**
     * Instance of RequestHandler.
     * 
     * @var RequestHandler
     */
    private $request = null;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->api = new Api();
    }
    
    /**
     * Proccess the route of request.
     */
    public function route()
    {
        echo "<pre>";
        print_r($_SERVER);
        echo "</pre>";
        // if request method is get
        if ($this->request->isGET())
        {
            if ($this->request->getResource() == $this->api->getResourceName())
            {
                
            }
        }
        else
        {
            
        }
    }
}
