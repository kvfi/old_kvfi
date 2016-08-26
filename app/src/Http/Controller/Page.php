<?php

namespace App\Http\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Page extends \App\Http\Controller
{

  const table = 'pages';

  public function view(Request $request, Response $response, Array $args) {
    $page = new \App\Factory\PageFactory($this->ci, $args);
    if ($page->exists()) {
      $page_data = $page->getProperties();
      return $this->ci->view->render($response, 'page.twig', array(
          'config' => $this->ci->get('webconf'),
          'headMeta' => [
              'title' => $page_data['title'],
          ],
          'data' => array(
              'page' => $page_data,
              /* 'comments' => $post->comments(),
              'comment_count' => count($post->comments()), */
          ),
      ));
    } else {
      $page->get404();
    }
    }
}
