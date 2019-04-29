<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function () use ($app) {
    return 'It Works';
});

$app->group('/api', function () use ($app) {
    $app->map(['GET', 'POST'], '/authenticate', 'AuthController:sso');
});
