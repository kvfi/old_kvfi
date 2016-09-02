<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\Page;

class PageController extends Controller
{
    public function get(Request $request, Response $response, Array $args)
    {
        $page = Page::where('slug', $request->getAttribute('route')->getArgument('slug'))->first();
        
        if (!$page) {
            return $this->pagenotfound;
        }

        return $this->view->render($response, 'page.twig', array(
          'headMeta' => [
              'title' => $page->title,
          ],
          'data' => array(
              'page' => $page,
              /* 'comments' => $post->comments(),
              'comment_count' => count($post->comments()), */
          ),
      ));
    }
}
