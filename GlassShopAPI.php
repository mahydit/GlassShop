<?php 
require_once("vendor/autoload.php");
$request =  new RequestHandler();
if($request->validate("items"))
{
    $items = new MySQLHandler("items");
    $response = new ResponseHandler($items);
    if($request->get__method() === "GET")
    {
        $response->handle_get($request->get__resource_id());
    }
    
}

?>