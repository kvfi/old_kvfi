<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\Page;
use App\Models\Post;
use App\Models\Category;

class PageController extends Controller
{
    public function get(Request $request, Response $response, array $args)
    {
        $page = Page::where('slug', $request->getAttribute('route')->getArgument('slug'))->first();

        if (!$page) {
            return $this->pagenotfound;
        }

        if (!empty($page->redirect_to)) {
            return $response->withRedirect($this->router->pathFor('page', ['slug' => $page->redirect_to]));
        }

        return $this->view->render($response, 'page.twig', array(
        'headMeta' => [
            'title' => $page->title,
            'description' => $page->intro,
        ],
        'data' => array(
            'page' => $page,
            'category' => Category::where('slug', $page->category)->first(),
            'content' => $this->getPageContent($page->slug),
            /* 'comments' => $post->comments(),
            'comment_count' => count($post->comments()), */
        ),
      ));
    }

    protected function getPageContent($slug)
    {
        $path = __DIR__.'/../../../resources/files/pages/'.$slug.'.md';
        if (file_exists($path)) {
            $file = file_get_contents($path, FILE_USE_INCLUDE_PATH);

            return $file;
        } else {
            return false;
        }
    }

    public function contact(Request $request, Response $response, array $args)
    {
        return $this->view->render($response, 'contact.twig', array(
        'headMeta' => [
            'title' => 'Contact me',
        ]
      ));
    }

    public function tdj(Request $request, Response $response, array $args)
    {
        return $this->view->render($response, 'extras/theoremes.twig', array(
            'headMeta' => [
                'title' => 'Théorème du jour',
                'desc' => 'Découvrez chaque nouveau théorème mathématique expliqué de manière simple.'
            ],
            'data' => [
                'theorems' => Post::where('type', '=', 'theorem')->all(),
            ]
        ));
    }
}