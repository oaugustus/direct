<?php

namespace Direct;
/**
 * Response class that handle http responses.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Response
{
    /**
     * Default resource page.
     * 
     * @var string
     */
    private $defaultResource = 'index.html';

    /**
     * Define views location.
     * 
     * @var string
     */
    private $viewsLocation = 'views/';
    /**
     * Render the response
     *
     * @param string $response
     */
    public function render($response)
    {
        echo $response;
    }

    /**
     * Serve an requested resource.
     * 
     * @param string $resource
     */
    public function serve($resource)
    {
        $resource = ($resource !== '') ? $resource : $this->defaultResource;
        $file = $this->viewsLocation.$resource;

        if (!file_exists($file))
        {
            throw new \Exception("The {$resource} was not found in {$this->viewsLocation} directory!");
        }

        $this->render(file_get_contents($file));        
    }
}
