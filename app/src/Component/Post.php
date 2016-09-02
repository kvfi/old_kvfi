<?php

namespace App\Factory;

class Post extends \App\Http\Controller\Post
{
    public function comments()
    {
        $query = $this->ci->query('SELECT * comments WHERE post = '.$this->slug.' ORDER BY created_on DESC');

        return $query;
    }

    public function getAuthor()
    {
        $articleID = $this->fields()->author;
        $query = $this->app->db->select('users', "id = $articleID");

        return $query[0];
    }

    public function getProperties($args)
    {
        $this->args = $args;
        $query = $this->ci->get('posts', '*', ['slug' => $args['slug']]);
        $query['progress2'] = 'xD';
        $query['epistemic2'] = 'xD';

        $query['category'] = $this->ci->get('categories', ['name', 'slug', 'description'], ['slug' => $query['category']]);

        $query['extras'] = unserialize($query['extras']);

        return $query;
    }

    public function comment_count()
    {
        $query = $this->app->db->count('comments', ['comment_post' => $this->get('id')]);

        return $query;
    }

    public function get($field)
    {
        $query = $this->app->db->select('posts', '*', ['slug' => $this->slug]);

        return $query[0][$field];
    }
}
