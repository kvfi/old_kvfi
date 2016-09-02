<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
/* HOMEPAGE */
$app->get('/', 'HomeController:index')->setName('home');

/* Editor */
$app->group('/editor', function () {
    $this->get('/login', 'Auth\AuthController:getLogIn')->setName('editor.login');
    $this->post('/login', 'Auth\AuthController:postLogIn');
})->add(new GuestMiddleware($container));

$app->group('/editor', function () {
    $this->get('', 'Editor\HomeController:index')->setName('editor.home');
    $this->get('/logout', 'Auth\AuthController:getLogOut')->setName('editor.logout');
    $this->get('/password/change', 'Auth\PasswordController:getChangePassword')->setName('editor.password.change');
    $this->post('/password/change', 'Auth\PasswordController:postChangePassword');
})->add(new AuthMiddleware($container));

/* POST */
$app->get('/post/{slug}', 'App\Controllers\PostController:get')->setName('post');

/* Page */
$app->get('/{slug}', 'App\Controllers\PageController:get')->setName('post');
