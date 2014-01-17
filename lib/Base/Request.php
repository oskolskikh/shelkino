<?php

namespace Base;
	
class Request
{
    protected $files;
    protected $request;
    protected $accept;
    protected $output_format = "html";
    protected $server_info;
    protected $method;
    protected $file_path;
    protected $router="main";
    public function __construct()
    {
	$this->server_info = $_SERVER;
	$this->request = new DataHolder();
	$this->request->add($_REQUEST);
	$this->files = new DataHolder();
	if ($this->hasFiles())
	{
                   $this->files->add($_FILES);
	}
	$this->method = strtoupper(  $this->getServerInfo('REQUEST_METHOD', 'GET')     );
	$this->detectOutputFormat();
		
    }
    
    public function checkRequest()
    {
	$this->parsePath();
    }
    
    protected function parsePath()
    {
		
    }
	
    public function detectOutputFormat()
    {
	$format = strtolower($this->request->get("mode",$this->output_format));
	if (in_array($format,Constants::$allow_output_format)){
		$this->setOutputFormat($format);
	}else{
        	$this->setOutputFormat($this->output_format);
    	}
    }
    
    public function getRouter()
    {
        return $this->router;
    }
    
    public function setRouter($router)
    {
        $this->router = $router;
    }
    
    public function getOutputFormat()
    {
    	return $this->output_format;
    }
	
    //Set output format = json , xml or mixed
    public function setOutputFormat($format)
    {
	 $this->output_format = $format;
    }
	
	 
    public function hasFiles()
    {
        return (count($_FILES) > 0);
    }
    
    // alow upload only one file
    public function fileCount()
    {
        return count($_FILES);
    }
    
    public function getServerInfo($key = false, $value = NULL)
    {
        if ($key)
        {
            return array_key_exists($key, $this->server_info) ?
                $this->server_info[$key] : $value;
        }

        return $this->server_info;
    }
}