<?php

namespace Direct;

/**
 * Request class that handler http requests.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Request
{
    /**
     * Test is the request method is GET. Return true if it is right otherwise,
     * return false.
     *
     * @return boolean
     */
    public function isGET()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    /**
     * Test is the request method is POST. Return true if it is right otherwise,
     * return false.
     *
     * @return boolean
     */
    public function isPOST()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
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

    /**
     * Return the raw data from POST request
     *
     * @return Array
     */
    public function getRawData()
    {
        $data = json_decode($GLOBALS['HTTP_RAW_POST_DATA']);

        if (!is_array($data))
            $data = array($data);
        
        return $data;
    }
}