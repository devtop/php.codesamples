<?php

$router = new \Standard\Http\Router();

$strictResolver = new \Standard\Http\Router\MapResolver();
$strictResolver->setOptionStrict(true);
$strictResolver->setMap(['index' => '/']);
$router->addResolver($strictResolver);

$resolver = new \Standard\Http\Router\MapResolver();
$resolver->setMap(include __DIR__ . '/config/router.php');
$router->addResolver($resolver);

$routeMatch = $router->getRoutMatch($_SERVER['REQUEST_URI']);

if ($routeMatch === null) {
    header("HTTP/1.0 404 Not Found");
    exit;
}

