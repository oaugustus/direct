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
     * Instance of Request.
     * 
     * @var Request
     */
    private $request = null;

    /**
     * Instance of Response.
     * 
     * @var  Response
     */
    private $response = null;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->api = new Api();
    }
    
    /**
     * Proccess the route of request.
     */
    public function route()
    {
        // if request method is get
        if ($this->request->isGET())
        {
            if ($this->request->getResource() == $this->api->getResourceName())
            {
                // render the api
                $this->response->render($this->api->stringfy());
            }
            else
            {
                // render the page
                $this->response->serve($this->request->getResource());
            }
        }
        elseif ($this->request->isPOST())
        {
            
        }
    }
}
