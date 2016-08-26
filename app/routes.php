<?php
/* HOMEPAGE */


$app->get('/', 'App\Http\Controller\Home:view');

/* POST */
$app->get('/post/{slug}', 'App\Http\Controller\Post:view');

/* POST */
$app->get('/{slug}', 'App\Http\Controller\Page:view');
