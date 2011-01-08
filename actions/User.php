<?php
namespace actions;

class User
{
    /**
     * @remote true
     */
    public function test($params)
    {
        return "Hello ".$params['name'];
    }
}