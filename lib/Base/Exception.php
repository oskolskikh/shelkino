<?php

namespace Base;

/**
 * Exception
*/

class Exception extends \Exception
{
    protected $http_code;
    protected $name;
   
    public function __construct($message, $name, $http_code = 403)
    {
       $this->message	  = $message;
       $this->name        = $name;
       $this->http_code   = $http_code;
    }
   
    public function getName()
    {
        return $this->name;
    }

    public function getStatusCode()
    {
        return $this->http_code;
    }
  
    public function toArray()
    {
        return array(
            'errors' => array(
                array(
                    'message' => $this->getMessage(),
                    'name'    => $this->getName()
                )
            )
        );
    }
}