<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Core\Pagination\Paginator;
use \Mni\FrontYAML\Bridge\CommonMark\CommonMarkParser;
use App\Core\Utility;


class HomeController extends Controller
{
    const RESOURCES_MISC = __DIR__ . '/../../../resources/files/misc';
    const POSTS = __DIR__ . '/../../../resources/files/posts';

    public function index(Request $request, Response $response, $args)
    {
        $pagination = new Paginator(['total' => 100, 'item_per_page' => 20]);
        $parser = new \Mni\FrontYAML\Parser();
        $intro_parse = $parser->parse(file_get_contents(self::RESOURCES_MISC . '/intro.md', FILE_USE_INCLUDE_PATH));
        $intro = $intro_parse->getContent();
        $posts = [];
        for ($i = (date('Y') - 1); $i <= date('Y'); ++$i) {
           $posts[$i] = $this->get_by_year($i);
        }
    
        foreach ($posts as $year => $post) {    
            usort($posts[$year], [$this, "cmp_by_optionNumber"]);
        }

        $reponse = $this->view->render($response, 'home.twig', [
          'headMeta' => [
            'title' => 'Home',
            'description' => $this->container->webconf['site_description'],
          ],
          'data' => [
            'posts' => $posts,
            'intro' => $intro,
            // 'topics' => Post::orderBy('updated_at', 'DESC')->limit(3)->get(),
            /* 'experiment' => Post::where('type', '=', 'experiment')->orderBy('created_at', 'DESC')->first(),
            'theorem' => Post::where('type', '=', 'theorem')->orderBy('created_at', 'DESC')->first(),
            'pagination' => $pagination->render(), */

          ],
        ]);
        return $response;
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

    protected function get_by_year($year)
    {
        $posts = [];
        $posts = array_diff(scandir(self::POSTS), array('..', '.'));
        $parser = new \Mni\FrontYAML\Parser();
        foreach ($posts as $key => &$post) {
            $path = self::POSTS . '/' . $post;
            if (file_exists($path)) {
                $file = file_get_contents($path, FILE_USE_INCLUDE_PATH);
                $document = $parser->parse($file);
                $meta = $document->getYAML();
                $content = $document->getContent();
                $post = [];
                $post['meta'] = $meta;
                $post['content'] = $content;
                $meta['online'] = $meta['online'] ?? true;
                $meta['published'] = $meta['published'] ?? null;
                $meta['type'] = $meta['type'] ?? null;
                if (date("Y", $meta['published']) !== strval($year) OR $meta['online'] == false OR $meta['type'] == 'page') {
                    unset($posts[$key]);
                }
            } else {
                return false;
            }
        }
        return $posts;
    }

    protected function cmp_by_optionNumber($a, $b) {
          return $a['meta']["published"] < $b['meta']["published"];
        }
}
