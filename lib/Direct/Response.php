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
     * 
     */
    public function render($content)
    {
        echo $content;
    }
}
