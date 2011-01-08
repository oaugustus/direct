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
                $this->response->render($this->api);
            }
            else
            {
                // render the page
                $this->response->serve($this->request->getResource());
            }
        }
        elseif ($this->request->isPOST())
        {
            $calls = $this->request->getRawData();
            $response = array();
            
            foreach ($calls as $call)
            {
                $response[] = $this->dispatch($call);
            }

            $this->response->responde($response);
        }
    }

    /**
     * Dispatch all request calls.
     * 
     * @param StdClass $call
     */
    private function dispatch($call)
    {
        $actionClass = '\\actions\\'.str_replace('.', '\\', $call->action);

        if (!class_exists($actionClass))
        {
            throw new \Exception('The '.$call->action.' action not exists!');
        }

        // instantiate the action
        $action = new $actionClass();

        if (!is_callable(array($action, $call->method)))
        {
            throw new \Exception('The '.$this->method.' method not exists in '.$call->action.' action!');
        }
        $method = $call->method;

        $response = (array)$call;
        unset($response['data']);
        $response['result'] = $action->$method((array)$call->data[0]);
        
        return $response;
    }
}
