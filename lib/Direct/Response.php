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
    private $defaultResource = '';

    /**
     * Define views location.
     * 
     * @var string
     */
    private $viewsLocation = 'views/';

    public function __construct()
    {
        $this->defaultResource = Config::get('app.response.default_resource');
    }
    
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

        $loader = new \Twig_Loader_Filesystem(VIEW_PATH);
        $twig = new \Twig_Environment($loader, array(
            'cache' => Config::get('app.debug') ? false : CACHE_PATH.'/resource'
        ));

        $template = $twig->loadTemplate($resource);
        $this->render($template->display(Config::all()));
    }
}
