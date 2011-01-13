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
    private $defaultResource = null;

    /**
     * Define views location.
     * 
     * @var string
     */
    private $viewsLocation = null;

    public function __construct()
    {
        $this->defaultResource = Config::get('app.response.default_resource');
        $this->viewsLocation = Config::get('app.response.views_location');
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
     * Responde a request call.
     * 
     * @param array $response
     * @param bolean $upload
     */
    public function respond($response, $upload = false)
    {        
        if (!$upload)
        {
            $this->render(json_encode($response));
        }
        else
        {
            $format = '<html><body><textarea>%s</textarea></body></html>';
            $this->render(sprintf($format,json_encode($response)));
        }
        
    }
    /**
     * Serve a requested resource.
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
