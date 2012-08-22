<?php

require_once '../library/sframe/mvc/dispatcher.class.php';
require_once '../library/sframe/mvc/controller.class.php';


// Let's get the controll and action from the URI
$uri = array_slice(explode('/', $_SERVER['REQUEST_URI']), 1);

if (empty($uri[0])) {
    $uri[0] = 'index';
}

if (empty($uri[1])) {
    $uri[1] = 'index';
}

$dispatcher = new sframe_mvc_Dispatcher();
$dispatcher->setController($uri[0]);
$dispatcher->setAction($uri[1]);
$dispatcher->dispatch();

?>
