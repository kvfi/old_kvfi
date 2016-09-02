<?php

namespace App\Factory;

class PostFactory extends \App\Http\Controller\Post
{
    public function __construct($ci, $args)
    {
        $this->ci = $ci;
        $this->args = $args;
    }

    public function getProperties()
    {
        $args = $this->args;

        return $this->ci->database->get(
        'posts', '*', ['slug' => $args['slug']]
      );
    }

    public function comments()
    {
        $post = $this->getProperties();

        return $this->ci->database->select(
      'comments', '*', [
        'post' => $post['id'],
      ]
    );
    }

    public function get($var)
    {
        return $this->$var;
    }
}
