<?php
// DIC configuration
//

use Respect\Validation\Validator as v;

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------


$container['auth'] = function ($c) {
    return new \App\Auth\Auth;
};

// Flash messages
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};


// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $c->auth->check(),
        'user' => $c->auth->user()
    ]);

    $view->getEnvironment()->addGlobal('flash', $c->flash);
    $view->getEnvironment()->addGlobal('config', $c->settings['webconf']);

    return $view;
};

$container['pagenotfound'] = function ($c) {
    return $c->view->render($c->response->withStatus(404), '404.twig');
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['database']);
$capsule->setAsGlobal();
$capsule->bootEloquent();



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

$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

$container['validator'] = function ($c) {
    return new App\Core\Validation\Validator;
};

$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard;
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
    'PostController'
];

foreach ($controllers as $controller) {
    $container[$controller] = function ($c) use($controller) {
        $controller = '\App\Controllers\\' . $controller;
        return new $controller($c);
    };
}

// -----------------------------------------------------------------------------
// Middleware
// -----------------------------------------------------------------------------

$middlewares = [
    'CsrfViewMiddleware',
    'OldInputMiddleware',
    'ValidationErrorsMiddleware',
];

foreach ($middlewares as $middleware) {
    if (substr($middleware, 0, 1) !== '\\') {
        $middleware = '\\App\Middleware\\' . $middleware;
    }
    $app->add(new $middleware($container));
}

$app->add($container->csrf);

// -----------------------------------------------------------------------------
// Validator rules
// -----------------------------------------------------------------------------

v::with('App\\Core\\Validation\\Rules\\');