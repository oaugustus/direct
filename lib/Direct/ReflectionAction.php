<?php
namespace Direct;
/**
 * ReflectionAction class that do reflection to get API spec from Action.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class ReflectionAction
{
    /**
     * RelfectionClass instance.
     * 
     * @var ReflectionClass
     */
    private $reflection = null;

    /**
     * Define the remote attribute to exposes a method to api.
     * 
     * @var string
     */
    private $remoteAttribute = '@remote';

    /**
     * Define the form attribute to setup a method as form handler.
     * 
     * @var string
     */
    private $formAttribute = '@form';
    
    /**
     * Instantiate a ReflectionClass object to action class.
     * 
     * @param string $action
     */
    public function __construct($action)
    {
        $this->reflection = new \ReflectionClass($action);
    }

    /**
     * Return the Action Direct Api.
     * 
     * @return mixed (array, boolean)
     */
    public function getApi()
    {
        $api = false;
        $methods = $this->reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method)
        {
            $mApi = $this->getMethodApi($method);
            
            if ($mApi)
                $api[] = $mApi;
        }


        return $api;
    }


    /**
     * Return the api of method.
     * 
     * @param \ReflectionMethod $method
     * 
     * @return mixed (array/boolean)
     */
    private function getMethodApi($method)
    {
        $api = false;
        
        if (strlen($method->getDocComment()) > 0)
        {
            $doc = $method->getDocComment();

            $isRemote = !!preg_match('/' . $this->remoteAttribute . '/', $doc);
            
            if ($isRemote)
            {
                $api['name'] = $method->getName();
                $api['len'] = $method->getNumberOfParameters();

                if(!!preg_match('/' . $this->formAttribute . '/', $doc))
                {
                    $api['formHandler'] = true;
                }

            }
        }

        return $api;
    }
}