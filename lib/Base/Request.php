<?php
/*
 *  Request Class
 */

namespace Base;

class Request
{
    public $server;
    public $files;
    public $data;
    public $hasFiles =false;
    
    public function __construct()
    {
        
	$this->server = new DataHolder($_SERVER);
	$this->setFiles();
        $this->data = new DataHolder($_REQUEST);
    }
    
    public function setFiles(){
        if (isset($_FILES) && !empty($_FILES))
        {
            $this->files = new DataHolder($_FILES);
            $this->hasFiles = true;
        }else{
            $this->hasFiles = false;
        }
            
    }
    
    public function method()
    {
       return $this->server->get('REQUEST_METHOD', 'GET');
    }
}
