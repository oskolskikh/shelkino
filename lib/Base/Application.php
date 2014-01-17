<?php

namespace Base;

/* 
 * @package  JTS
*/

 class Application
 {
     
    public static function createWebApplication()
    {
        return self::createApplication('Base\WebApplication');
    }
    
    public static function createApplication($class)
    {
	return new $class();
    }
    
 }
