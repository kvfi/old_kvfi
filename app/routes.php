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
    $this->get('', 'Editor\MainController:index')->setName('editor.home');

    $this->get('/posts', 'Editor\MainController:getPosts')->setName('editor.posts');
    $this->get('/pages', 'Editor\MainController:getPages')->setName('editor.pages');

    $this->get('/new/post', 'Editor\MainController:getNewPost')->setName('editor.new.post');
    $this->post('/new/post', 'Editor\MainController:postNewPost');

    $this->get('/post/update/{id}', 'Editor\MainController:getEditPost')->setName('editor.edit.post');
    $this->post('/post/update/{id}', 'Editor\MainController:postEditPost');

    /* pages */
    $this->get('/new/page', 'Editor\MainController:getNewPage')->setName('editor.new.page');
    $this->post('/new/page', 'Editor\MainController:postNewPage');

    $this->get('/page/update/{id}', 'Editor\MainController:getEditPage')->setName('editor.edit.page');
    $this->post('/page/update/{id}', 'Editor\MainController:postEditPage');

    $this->get('/logout', 'Auth\AuthController:getLogOut')->setName('editor.logout');

    $this->get('/password/change', 'Auth\PasswordController:getChangePassword')->setName('editor.password.change');
    $this->post('/password/change', 'Auth\PasswordController:postChangePassword');
})->add(new AuthMiddleware($container));

/* POST */
/* $app->get('/post/{slug}', 'App\Controllers\PostController:get')->setName('post'); */

/* Page */
$app->get('/Archives', 'App\Controllers\PostController:archives')->setName('archives');
// $app->get('/contact', 'App\Controllers\PageController:contact')->setName('contact');
$app->get('/{slug}', 'App\Controllers\PostController:get')->setName('post');

/* TAG */
$app->get('/tags/{slug}', 'App\Controllers\TagController:get')->setName('tag');

/* Special page */
