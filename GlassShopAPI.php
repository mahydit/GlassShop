<?php 
require_once("vendor/autoload.php");
$request =  new RequestHandler();
if($request->validate("items"))
{
    $items = new MySQLHandler("items");
    $response = new ResponseHandler($items);
    switch ($request->get__method()) {
        case 'GET':
            $response->handle_get($request->get__resource_id());
            break;
        case 'POST':
            echo "Post";
            $response->handle_post($request->get__parameters());
            break;
        case 'PUT':
            $response->handle_put($request->get__parameters(),$request->get__resource_id());
            break;
        case 'DELETE':
            $response->handle_delete($request->get__resource_id());
            break;
        case 'OPTIONS':
            $response->handle_options($request->get__allowed_methods());
            break;        
        default:
            $response->output_with_error(404,array("error"=>"Method not allowed"));
    }
    // if($request->get__method() === "GET")
    // {
    //     $response->handle_get($request->get__resource_id());
    // }
    
}

?>