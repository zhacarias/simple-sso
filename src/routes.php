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

$app->post('/', function () use ($app) {
    return 'test';
});

$app->group('/api', function () use ($app) {
    $app->post('/authenticate', 'AuthController:sso');
});
