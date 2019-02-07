<?php

class RequestHandler {
    private $__method;
    private $__parameters = array();
    private $__resource;
    private $__resource_id;
    private $__allowed_methods= array("GET","POST","DELETE","PUT");
    
    
    function get__method() {
        return $this->__method;
    }

    function get__parameters() {
        return $this->__parameters;
    }

    function get__resource() {
        return $this->__resource;
    }

    function get__resource_id() {
        return $this->__resource_id;
    }

    
 

    public function __construct() {
        $this->__method = $_SERVER["REQUEST_METHOD"];
        $url_pieces = explode("/",$_SERVER["REQUEST_URI"]);
        // var_dump($url_pieces);
        $this->__resource = (isset($url_pieces[3]))? $url_pieces[3] : "" ;
        $this->__resource_id =(isset($url_pieces[4]) && is_numeric($url_pieces[4]) ) ?$url_pieces[4] : "";
        if($this->__method == "POST" || $this->__method =="PUT")
        {
            $this->__parameters = json_decode(file_get_contents('php://input'),true); 
        }
    }

     //***********************************************************************************************************
    //this function should output or return the request elements (resource, method, parameters and resource id)
	//if $output is false the function should returns otherwise it should echo the response in JSON formats
	//***********************************************************************************************************
    public function scan($output=true){   
    }
	//***********************************************************************************************************
    //this function should validate the request 
	//if $output is false the function should returns the result otherwise it should echo the results in JSON formats
	//$correct_resource : The resource which the service should accepts, "items" in this example. 
	//***********************************************************************************************************
    public function validate($correct_resource,$output = true){
      if($this->__resource !== $correct_resource)
      {
        if($output)
        {
            ResponseHandler::output_with_error(404,"Resource not found 01");
        }
        else
        {
            return false;
        }
      }
      elseif(!is_numeric($this->__resource_id))
      {
        if($output)
        {
            ResponseHandler::output_with_error(404,"Resource not found 02");
        }
        else
        {
            return false;
        }
      }
      elseif (!in_array($this->__method,$this->__allowed_methods)) 
      {
        if($output)
        {
            ResponseHandler::output_with_error(404,"Method not allowed");
        }
        else
        {
            return false;
        }
      }
      else
      {
            return true;
      }
    }
    
    

}
?>
