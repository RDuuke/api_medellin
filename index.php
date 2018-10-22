<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once "vendor/autoload.php";
define("DS", DIRECTORY_SEPARATOR);
define("BASE_PATH", dirname(__FILE__) . DS );


require_once BASE_PATH . "config" . DS . "bootstrap.php";


/*
$app->delete("/", function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $arg){
    //
    print_r($request->getHeader("PHP_AUTH_USER"));
    print_r($request->getHeader("PHP_AUTH_PW"));
    ///return $response->withJson(["status" => 1, "message" => "Usuario correcto"], 200);
});
*/
$app->run();