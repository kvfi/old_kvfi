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
        for ($i = 2015; $i <= date('Y'); ++$i) {
            $posts[$i] = Post::where('type', '<>', 'theorem')->where('type', '<>', 'experiment')->whereYear('created_at', '=', $i)->orderBy('created_at', 'DESC')->get();
        }

        $reponse = $this->view->render($response, 'home.twig', [
          'headMeta' => [
            'title' => 'Home',
            'description' => $this->container->webconf['site_description'],
          ],
          'data' => [
            'posts' => $posts,
            'intro' => $this->getIntroText(),
            // 'topics' => Post::orderBy('updated_at', 'DESC')->limit(3)->get(),
            'experiment' => Post::where('type', '=', 'experiment')->orderBy('created_at', 'DESC')->first(),
            'theorem' => Post::where('type', '=', 'theorem')->orderBy('created_at', 'DESC')->first(),
            'pagination' => $pagination->render(),

          ],
        ]);

        return $reponse;
    }

    protected function getIntroText()
    {
        $path = __DIR__.'/../../../resources/files/misc/intro.md';
        if (file_exists($path)) {
            $file = file_get_contents($path, FILE_USE_INCLUDE_PATH);

            return $file;
        } else {
            return false;
        }
    }
}
