<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

//$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});

$app->get('/', function () use ($app) {
    return 'It Works';
});

$app->group('/api', function () use ($app) {
    $app->map(['GET', 'POST'], '/authenticate', 'AuthController:sso');
});
