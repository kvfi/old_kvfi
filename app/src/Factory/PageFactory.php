<?php

namespace App\Factory;

use App\Http\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class PageFactory extends \App\Http\Controller\Page
{

  public function __construct($ci, $args) {
    $this->ci = $ci;
    $this->args = $args;
  }

  protected function exists() {
    $args = $this->args;
    return $this->ci->database->has(
    'pages',
    [
      'slug' => $args['slug']
    ]
  );
  }

    public function getProperties()
    {
      $args = $this->args;
      return $this->ci->database->get(
        parent::table, '*', ['slug' => $args['slug']]
      );
    }

    public function comments() {
      $post = $this->getProperties();
      return $this->ci->database->select(
      'comments', '*', [
        'post' => $post['id']
      ]
    );
    }

    public function get404($message = null) {
      return $this->ci->view->render($this->ci->response, '404.twig', [
        'config' => $this->ci->get('webconf'),
        'headMeta' => [
          'title' => 'Woops...',
        ],
        'css_class' => 'not_found'
      ]);
    }
}
