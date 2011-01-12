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
            if ($this->request->isFormCall())
            {
                $this->response->responde($this->dispatchForm($this->request->getData()),$this->request->isUpload());
            }
            else
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
    }

    /**
     * Dispatch a form request call.
     * 
     * @param array $data
     * @return array
     */
    private function dispatchForm($data)
    {
        $args = $data;

        $response = (array(
            'tid' => $data['extTID'],
            'action' => $data['extAction'],
            'method' => $data['extMethod'],
            'type' => $data['extType'],
            'upload' => $data['extUpload']
        ));
        
        // sanitize
        unset($args['extTID']);
        unset($args['extAction']);
        unset($args['extMethod']);
        unset($args['extType']);
        unset($args['extUpload']);

        $partial = str_replace(Config::get('app.api.namespace').'.','',$data['extNamespace'].".".$data['extAction']);

        $actionClass = '\\actions\\'.str_replace('.', '\\', $partial);

        $this->checkAction($actionClass);

        // instantiate the action
        $action = new $actionClass();

        $this->checkMethod($action, $data['extMethod']);
        $method = $data['extMethod'];
        
        $response['result'] = $action->$method($args);

        return $response;
    }
    
    /**
     * Dispatch all request calls.
     * 
     * @param StdClass $call
     * @return array
     */
    private function dispatch($call)
    {
        $partial = str_replace(Config::get('app.api.namespace').'.','',$call->namespace.".".$call->action);

        $actionClass = '\\actions\\'.str_replace('.', '\\', $partial);

        $this->checkAction($actionClass);
        
        // instantiate the action
        $action = new $actionClass();

        $this->checkMethod($action, $call->method);
        
        $method = $call->method;

        $response = (array)$call;
        unset($response['data']);
        $response['result'] = $action->$method((array)$call->data[0]);
        
        return $response;
    }

    /**
     * Check if an action exists.
     * 
     * @param string $action
     */
    private function checkAction($action)
    {
        if (!class_exists($action))
        {
            throw new \Exception('The '.$action.' action not exists!');
        }        
    }

    /**
     * Check if an action method is callable.
     * 
     * @param Object $action
     * @param string $method
     */
    private function checkMethod($action, $method)
    {
        if (!is_callable(array($action, $method)))
        {
            throw new \Exception('The '.$method.' method not exists in '.$action.' action!');
        }
    }
}
