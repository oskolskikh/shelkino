<?php

    namespace Base;
    
    
    class WebApplication
    {
      	protected $config;
        
        public function __construct($configuration = array())
        {
            $this->config = new Config($configuration);
            
        }
    }