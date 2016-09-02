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

        return $this->view->render($response, 'home.twig', [
          'headMeta' => [
              'title' => 'Home',
          ],
          'data' => [
              'posts' => Post::limit(10)->orderBy('created_at', 'DESC')->get(),
              'pagination' => $pagination->render(),
          ],
      ]);
    }
}
