<?php
// DIC configuration

$container = $app->getContainer();

// Load env
$env = new \Dotenv\Dotenv(dirname(__DIR__));
$env->load();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Controller
$container['AuthController'] = function ($c) use ($container) {
    return new App\Controller\AuthController($container);
};
