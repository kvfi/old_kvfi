<?php

namespace App\Factory;

use App\Http\Controller;

class HomeFactory extends \App\Http\Controller\Post
{
  protected $limit = '20';

  public function __construct($ci, $args) {
    $this->ci = $ci;
    $this->args = $args;
  }

  public function getPosts($limit = 100) {
    return $this->ci->database->select(
    'posts',
    [
      'id',
      'title',
      'slug',
      'created_on'
    ],
    [
      'ORDER' => [
        'created_on' => 'DESC'

      ],
      'LIMIT' => $limit,
    ]
  );

  }
}
