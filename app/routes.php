<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
/* HOMEPAGE */

$app->get('/', 'HomeController:index')->setName('home');

/* Editor */



/* POST */
/* $app->get('/post/{slug}', 'App\Controllers\PostController:get')->setName('post'); */

/* Page */
$app->get('/Archives', 'App\Controllers\PostController:archives')->setName('archives');
// $app->get('/contact', 'App\Controllers\PageController:contact')->setName('contact');
$app->get('/{slug}', 'App\Controllers\PostController:get')->setName('post');
$app->get('/Links/{year}/{month}', 'App\Controllers\PostController:get')->setName('link');


/* TAG */
$app->get('/tags/{slug}', 'App\Controllers\TagController:get')->setName('tag');

/* Special page */
