<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Core\Pagination\Paginator;
use \Mni\FrontYAML\Bridge\CommonMark\CommonMarkParser;

class PageController extends Controller
{
    const RESOURCES_MISC = __DIR__ . '/../../../resources/files/misc';
    const POSTS = __DIR__ . '/../../../resources/files/posts';
    const LINKS = __DIR__ . '/../../../resources/files/links';

    public function newsletter(Request $request, Response $response, $args)
    {
        $posts = [];
        $posts = array_diff(scandir(self::LINKS), array('..', '.'));
        $parser = new \Mni\FrontYAML\Parser();
        foreach ($posts as $key => &$post) {
            $path = self::LINKS . '/' . $post;
            if (file_exists($path)) {
                $date = \DateTime::createFromFormat('m-Y', mb_substr($post, 4, 2) . '-' . mb_substr($post, 0, 4));
                $post = ['file' => $post];
                $posts[$key]['date'] = $date->format('M Y');
            } else {
                return false;
            }
        }

        return $this->view->render($response, 'pages/Newsletter.twig', array(
                    'headMeta' => [
                        'title' => 'Newsletter and Links' ?? '',
                        'description' => 'Newsletter page containing my writing list and links.' ?? ''
                    ],
                    'data' => array(
                        'links' => $posts
                    ),
                ));
        unset($posts);
    }

}