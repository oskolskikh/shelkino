<?php

  namespace Base;
    
  class WebApplication
  {
      	protected $request;
	
	protected $config;
	
	protected $output ="";
        
        protected $data;
	
	public function __construct()
	{
        	$this->request = new Request();
                
	}
	//get config
	public function getConfig()
	{
		return $this->config;
	}
	
        public function getOutputFormat()
        {
            return $this->getRequest()->getOutputFormat();
        }
        
        public function getRouter()
        {
            return $this->getRequest()->getRouter();
        }
        
	public function processOutput()
	{
		$this->getRequest()->checkRequest();
                $this->run();
		return Output::getInstance($this->getOutputFormat())
                        ->setRouter($this->getRouter())
                        ->populateOutput()
                        ->executeOutput();
	}
	
        protected function run()
        {
            $this->data = array();
        }
	public function getRequest()
	{
		return $this->request;	
	}
	
	public function processError(Exception $e)
	{
		$this->output = Output::getInstance("error")->populateOutput($e->toArray())
               ->sendHeaders($e)
               ->executeOutput();
		return $this->output;
	}

}