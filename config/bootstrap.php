<?php
require_once "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager;
use Api\Controllers\UniversityController;
use Api\Controllers\ProgramsController;
use Api\Controllers\NewsController;

$app = new Slim\App(require_once BASE_PATH . DS . "config" . DS . "database.php");

$container =  $app->getContainer();

$capsule = new Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

$container['UniversityController'] = function ($container) {
    return new UniversityController($container);
};

$container['ProgramsController'] = function ($container) {
    return new ProgramsController($container);
};
$container['NewsController'] = function ($container) {
    return new NewsController($container);
};

require_once BASE_PATH .  DS . "src" . DS . "routes.php";
