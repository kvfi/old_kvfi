<?php
// DIC configuration
//

use Respect\Validation\Validator as v;

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

    $unserialize = new Twig_SimpleFilter('unserialize', function ($serial) {
        return unserialize($serial);
    });

     $implode = new Twig_SimpleFilter('implode', function ($array) {
        return implode(', ', $array);
    });

    $toHTML = new Twig_SimpleFilter('toHTML', function ($md) {
        $html = new App\Core\ParsedownExtraPlugin();

        return $html->text($md);
    });

    $removeTLCommas = new Twig_SimpleFilter('removeTLCommas', function ($string) {
        return rtrim($string, ",");
    });

    $view->getEnvironment()->addFilter($unserialize);
    $view->getEnvironment()->addFilter($implode);
    $view->getEnvironment()->addFilter($toHTML);
    $view->getEnvironment()->addFilter($removeTLCommas);

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $c->auth->check(),
        'user' => $c->auth->user(),
    ]);

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

$capsule = new \Illuminate\Database\Capsule\Manager();
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
    return new App\Core\Validation\Validator();
};

$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard();
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

// -----------------------------------------------------------------------------
// Middleware
// -----------------------------------------------------------------------------
$app->add(new \App\Middleware\CsrfViewMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));

$app->add($container->csrf);

// -----------------------------------------------------------------------------
// Validator rules
// -----------------------------------------------------------------------------

v::with('App\\Core\\Validation\\Rules\\');
