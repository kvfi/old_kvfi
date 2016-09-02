<?php
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'addContentLengthHeader' => true, // optional needs to be check

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],

        'database' => [
          'driver' => 'mysql',
          'database' => 'blog',
          'host' => 'localhost',
          'username' => 'root',
          'password' => 'oujda',
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci',
          'prefix' => '',
        ],

        'webconf' => [
          'site_url' => 'scif.ml.dev',
          'site_name' => 'Science FML',
          'site_locale' => 'en-US',
          'assets' => [
            'css' => '/static/css/',
            'js' => '/static/js/',
            'images' => '/static/img/'
          ]
        ]
    ],
];
