<?php

namespace Direct;

/**
 * Request class that handler http requests.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Request
{
    public function __construct()
    {
        
    }

    /**
     * Test is the request method is GET. Return true is right otherwise,
     * return false.
     *
     * @return boolean
     */
    public function isGET()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }

    /**
     * Return the resource requested by request.
     *
     * @return string
     */
    public function getResource()
    {
        $parts = explode('/',$_SERVER['REQUEST_URI']);
        
        return end($parts);
    }
}