<?php
class REST 
{
    public $content_type = "application/json";
    public $request = array();
    
    
    public function __construct() 
    {
        $this->inputs();
    }
    
    public function response($data) 
    {
        $this->headers();
        echo $data;
    }
    
    public function headers() 
    {
        header("Content-Type:".$this->content_type);
    }
    
  
    
    private function inputs() 
    {
        switch($this->get_request()) 
        {
            case "GET":
                $this->request = $this->filter($_GET);
                break;
                
            case "POST":
                $this->request = $this->filter($_POST);
                break;
                
            case "DELETE":
                $this->request = $this->filter($_GET);
                break;
                
            case "PUT":
                parse_str(file_get_contents("php://input"),$this->request);
                $this->request = $this->filter($this->request);
                break;
        }
    }
   
    
    
    private function filter($data) 
    {
        $filter_input = array();
        if(is_array($data)) 
        {
            foreach($data as $i => $v) 
            {
                $filter_input[$i] = $this->filter($v);
            }
        } 
        else 
        {
            if(get_magic_quotes_gpc()) 
            {
                $data = trim(stripslashes($data));
            }
            $data = strip_tags($data);
            $filter_input = trim($data);
        }
        return $filter_input;
    }
    
    
    
    public function get_request() 
    {
        return $_SERVER["REQUEST_METHOD"];
    }
}