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
     * Test if the request method is POST. Return true if it is right otherwise,
     * return false.
     *
     * @return boolean
     */
    public function isPOST()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * Test if the request call if a form call. Return true if it is right
     * otherwise, return false.
     * 
     * @return boolean
     */
    public function isFormCall()
    {
        return isset($_POST['extTID']);
    }

    /**
     * Test if the request call if upload form call. Return true if it is right
     * otherwise, return false.
     *
     * @return boolean
     */
    public function isUpload()
    {
        return $_POST['extUpload'] == 'false' ? false : true;
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

    /**
     * Return the data from POST request.
     *
     * @return array
     */
    public function getData()
    {
        return $_POST;
    }
}