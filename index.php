<?php
require_once __DIR__ . '/router.php';

$requestUri = $_SERVER['REQUEST_URI'];

$router = new Router;
$router->run($requestUri);