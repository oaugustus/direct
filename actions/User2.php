<?php
namespace actions;

class User2
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