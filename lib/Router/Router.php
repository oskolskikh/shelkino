<?php

namespace Router;

/**
 * Description of Router
 *
 * @author oskolok
 */
class Router {
     

   public function __construct($class = '')
   {
            $this->class = $class;
   }

    public function newInstance($path, $name = null)
    {
        $class = $this->class;
        return new $class($path, $name);
    }
}
