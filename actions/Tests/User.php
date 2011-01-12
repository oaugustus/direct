<?php
namespace actions\Tests;

class User
{
    /**
     * @remote true
     */
    public function test($params)
    {
        return "Hello ".$params['name'];
    }

    /**
     * @remote
     * @form 
     */
    public function sendForm($data)
    {
        return true;
    }
}