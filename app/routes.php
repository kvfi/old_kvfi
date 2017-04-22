<?php
/* HOMEPAGE */

$app->get('/', 'HomeController:index')->setName('home');

/* Editor */



/* POST */
/* $app->get('/post/{slug}', 'App\Controllers\PostController:get')->setName('post'); */

/* Page */
$app->get('/Archives', 'App\Controllers\PostController:archives')->setName('archives');
$app->get('/Newsletter', 'App\Controllers\PageController:newsletter')->setName('page.newsletter');
$app->get('/{slug}', 'App\Controllers\PostController:get')->setName('post');
$app->get('/Links/{year}/{month}', 'App\Controllers\PostController:get')->setName('link');

/* TAG */
$app->get('/tags/{slug}', 'App\Controllers\TagController:get')->setName('tag');

/* Special page */
