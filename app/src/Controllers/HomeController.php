<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\Post;
use App\Models\Page as Topic;
use App\Core\Pagination\Paginator;

class HomeController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        $pagination = new Paginator(['total' => 100, 'item_per_page' => 20]);
        $posts = [];
        for ($i = 2010; $i <= date('Y'); ++$i) {
            $posts[$i] = Post::whereYear('created_at', '=', $i)->orderBy('created_at', 'DESC')->get();
        }

        return $this->view->render($response, 'home.twig', [
          'headMeta' => [
            'title' => 'Home',
            'description' => $this->container->webconf['site_description']
          ],
          'data' => [
            'posts' => $posts,
            'topics' => Topic::orderBy('updated_at', 'DESC')->limit(3)->get(),
            'pagination' => $pagination->render(),
          ],
      ]);
    }
}
