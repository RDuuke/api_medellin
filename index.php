<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once "vendor/autoload.php";
define("DS", DIRECTORY_SEPARATOR);
define("BASE_PATH", dirname(__FILE__) . DS );


require_once BASE_PATH . "config" . DS . "bootstrap.php";


$app->run();