<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function get(Request $request, Response $response, $args)
    {
        $post = Post::where('slug', $request->getAttribute('route')->getArgument('slug'))->first();

        return $this->view->render($response, 'post.twig', array(
        'headMeta' => [
            'title' => $post->title,
            'description' => $page->intro
        ],
        'data' => array(
            'post' => $post,
            'category' => Category::where('slug', $post->category)->first(),
            /* 'comments' => $post->comments(),
            'comment_count' => count($post->comments()), */
        ),
    ));
    }
}
