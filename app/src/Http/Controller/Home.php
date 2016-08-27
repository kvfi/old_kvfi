<?php

namespace App\Http\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Home extends \App\Http\Controller
{

  public function view(Request $request, Response $response, $args) {
    $home = new \App\Factory\HomeFactory($this->ci, $args);
    /* $page = 1;
    $pagination = new \App\Core\Pagination($page, 200); */
    return $this->ci->view->render($response, 'home.twig', [
      'config' => $this->ci->get('webconf'),
      'headMeta' => [
        'title' => 'Home',
      ],
      'data' => [
        'posts' => $home->getPosts(),
            /* 'comment_count' => count($post->comments()), */
        /* 'pagination' => $pagination->parse() */
      ]
    ]);
    }
}
