<?php
class ResponseHandler {

    private $db;  //an object from MYSQLHandler class
    private $logger;  //logger object to log response if needed (bonus)
	
	
   //$db : an object from MYSQLHandler class
    public function __construct($db,$logger=null) {
		$this->db = $db;
    }

    //***********************************************************************************************************
	//use this function for output all success responses
	//it has a log parameters just incase you want to log the response (bonus)
	//$data could be any thing you send but mostlikely it will be an array or a confirmation message	
	//***********************************************************************************************************
    public static function output_with_success($data, $success_code = 200, $log = null) {
		header("Content-Type: application/json");
		$output = json_encode($data);
		if(!$output)
		{
			self::output_with_error(406,"Resources not acceptable");
		}
		else
		{
			http_response_code($success_code);
			echo $output;
		}
    }
    
	 //***********************************************************************************************************
	//use this function for output and log any error
	//it has a log parameters just incase you want to log the response (bonus)
	//$error message is the text you want to display for the client of your API 	
	//***********************************************************************************************************
    public static function output_with_error($code = 400, $error_msg, $log = null) {
		header("Content-Type: application/json");
		http_response_code($code);
		$error = array("error"=>$error_msg);
		echo json_encode($error);
    }
    
	 //***********************************************************************************************************
	//use this function to handle the GET HTTP Verb
	//$id is the resource_id	
	//***********************************************************************************************************
    public function handle_get($id) {
		$handler = $this->db;
		$response[0] = $handler->get_record_by_id($id);
		if(!empty($response[0]))
		{
			self::output_with_success($response[0]);
		}
		else
		{
			self::output_with_error(404,"Resource not found");
		}
    
    }
     //***********************************************************************************************************
	//use this function to handle the POST HTTP Verb
	//$params is sent params for a new resource
	//***********************************************************************************************************
    public function handle_post($params) {
    }

	//***********************************************************************************************************
	//use this function to handle the PUT HTTP Verb
	//$params is sent params for a new resource
	//$id is the resource_id
	//***********************************************************************************************************
    public function handle_put($params, $id) {
    }
    //***********************************************************************************************************
	//use this function to handle the GET HTTP Verb
	//$id is the resource_id
	//***********************************************************************************************************
    public function handle_delete($id) {
    }

}
?>