<?php

namespace App\Http\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Post extends \App\Http\Controller
{

  public function view(Request $request, Response $response, $args) {
    $post = new \App\Factory\PostFactory($this->ci, $args);
    $post_data = $post->getProperties();

    return $this->ci->view->render($response, 'post.twig', array(
        'config' => $this->ci->get('webconf'),
        'headMeta' => [
            'title' => $post_data['title'],
        ],
        'data' => array(
            'article' => $post_data,
            'comments' => $post->comments(),
            'comment_count' => count($post->comments()),
        ),
    ));
    }
}
