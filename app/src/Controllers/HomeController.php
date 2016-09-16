<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\Post;
use App\Core\Pagination\Paginator;

class HomeController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        $pagination = new Paginator(['total' => 100, 'item_per_page' => 20]);
        $posts = [];
        for ($i = 2010; $i <= date('Y'); $i++) {
          $posts[$i] = Post::whereYear('created_at', '=', $i)->orderBy('created_at', 'DESC')->get();
        }
        return $this->view->render($response, 'home.twig', [
          'headMeta' => [
              'title' => 'Home',
          ],
          'data' => [
              'posts' => $posts,
              'pagination' => $pagination->render(),
          ],
      ]);
    }
}
