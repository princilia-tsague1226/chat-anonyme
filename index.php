<?php

require "./configs/setting.php";

spl_autoload_register(function ($class) {
    $path = lcfirst(str_replace('\\', DIRECTORY_SEPARATOR, $class));
    
    $filename = $path.'.php';
    if (file_exists($filename)) {
        include $filename;
    }
});

use Controllers\RoomController;
use Services\Router;

$page = $_GET['page'] ?? 'room';

// var_dump(AVAILABLE_ROUTES);


$router = new Router($page);
$router->getController();
