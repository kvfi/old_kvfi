<?php
// DIC configuration
//


$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

$container['auth'] = function ($c) {
    return new \App\Auth\Auth();
};

// Flash messages
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

require "src/Core/ParsedownExtraPlugin.php";

// Twig
$container['view'] = function ($c) use ($app) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));
    $view->addExtension(new Twig_Extension_Debug());

    $view->getEnvironment()->addGlobal('current_url', $c->request->getUri());
    $view->getEnvironment()->addGlobal('base_path', $c->request->getUri()->getPath());
    $view->getEnvironment()->addGlobal('flash', $c->flash);
    $view->getEnvironment()->addGlobal('config', $c->settings['webconf']);

    return $view;
};

$container['pagenotfound'] = function ($c) {
    return $c->view->render($c->response->withStatus(404), '404.twig', [
        'headMeta' => [
              'title' => 'Woops XD',
          ],
    ]);
};


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));

    return $logger;
};

$container['webconf'] = function ($c) {
    $settings = $c->get('settings');

    return $settings['webconf'];
};

// -----------------------------------------------------------------------------
// Controllers
// -----------------------------------------------------------------------------

$controllers = [
    'Auth\AuthController',
    'Auth\PasswordController',
    'Editor\MainController',
    'HomeController',
    'PageController',
    'PostController',
];

foreach ($controllers as $controller) {
    $container[$controller] = function ($c) use ($controller) {
        $controller = '\App\Controllers\\'.$controller;

        return new $controller($c);
    };
}
