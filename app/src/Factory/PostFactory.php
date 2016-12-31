<?php

namespace App\Factory;

class PostFactory extends \App\Http\Controller\Post
{
    const POSTS = __DIR__ . '/../../../resources/files/posts';

    public function __construct($ci, $args)
    {
        $this->ci = $ci;
        $this->args = $args;
    }

    protected function get() {
        $parser = new \Mni\FrontYAML\Parser();
        $path = self::POSTS . '/' . $this->args;
        if (file_exists($path)) {
            $file = file_get_contents($path, FILE_USE_INCLUDE_PATH);
            $document = $parser->parse($file);
            return [
                'meta' => $document->getYAML(),
                'content' => $document->getContent();
            ];
        } else {
            return false;
        }
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
