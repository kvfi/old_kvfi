<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Core\Pagination\Paginator;
use \Mni\FrontYAML\Bridge\CommonMark\CommonMarkParser;

class PostController extends Controller
{
    const RESOURCES_MISC = __DIR__ . '/../../../resources/files/misc';
    const POSTS = __DIR__ . '/../../../resources/files/posts';

    public function get(Request $request, Response $response, $args)
    {
        $file = self::POSTS . '/' . $request->getAttribute('route')->getArgument('slug') . '.md';
        if (file_exists($file)) {
            $parser = new \Mni\FrontYAML\Parser();
            $post = $parser->parse(file_get_contents($file, FILE_USE_INCLUDE_PATH));
            $tpl = 'post.twig';
            if ($post === 'Théorèmes') {
                $cond['theorems'] = Post::where('type', 'theorem')->orderBy('created_at', 'DESC')->get();
                $cond['theorems_no'] = count($cond['theorems']);
            }
            if ($request->getAttribute('route')->getArgument('slug') == 'Contact') {
                $tpl = 'contact.twig';
            }
            $cond = [];
            $meta = $post->getYAML();
            $content = $post->getContent();
            $meta['tags'] = rtrim(implode(', ', $meta['tags'] ?? []), ', ');
            return $this->view->render($response, $tpl, array(
                'headMeta' => [
                    'title' => $meta['title'] ?? '',
                    'description' => $meta['subtitle'] ?? ''
                ],
                'data' => array(
                    'post' => ['meta' => $meta, 'content' => $content],
                    'cond' => $cond
                    /* 'comments' => $post->comments(),
                    'comment_count' => count($post->comments()), */
                ),
            ));
        } else {
            return $response->withStatus(404);
        }
    }

    protected function getPostContent($slug)
    {
        $path = __DIR__.'/../../../resources/files/posts/'.$slug.'.md';
        if (file_exists($path)) {
            $file = file_get_contents($path, FILE_USE_INCLUDE_PATH);
            return $file;
        } else {
            return false;
        }
    }

    protected function getFormattedPostTags($Id, $from = null)
    {
        if (is_null($from)) {
            $tags = Tag::where('post_id', '=', $Id)->pluck('name')->toArray();
        } elseif ($from = 'tagId') {
            $tags = Tag::where('name', '=', $Id)->pluck('name')->toArray();
        }
        $taglist = "";
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                // $taglist .= '<a href="'.$this->container->router->pathFor('post', ['slug' => 'Archives']).'?tag='.$tag.'">'.$tag . '</a>, ';
                $taglist .= $tag . ', ';
            }
        }
        return rtrim($taglist, ", "); 
    }

    public function archives(Request $request, Response $response, $args)
    {
        return $response->withStatus(404);
/*
        $posts = Tag::where('name', 'privacy')->posts();
        // print_r($posts);
        foreach ($posts as $post) {
            echo $post->name;
        }
        /* 

        $pagination = new Paginator(['total' => 100, 'item_per_page' => 20]);
        $posts = [];
        for ($i = 2010; $i <= date('Y'); ++$i) {
            $posts[$i] = Post::with('relatedTags')->find(18)->whereYear('created_at', '=', $i)->orderBy('created_at', 'DESC')->get();
        }

        $tags = $this->getFormattedPostTags($request->getParam('tags') ?? $request->getParam('tag'), 'tagId');

        $reponse = $this->view->render($response, 'archive.twig', [
            'headMeta' => [
            'title' => 'Home',
            'description' => $this->container->webconf['site_description'],
          ],
          'data' => [
            'posts' => $posts,
            // 'topics' => Post::orderBy('updated_at', 'DESC')->limit(3)->get(),
            'pagination' => $pagination->render(),
            'request' => [
                'category' => $request->getParam('category'),
                'epistemic' => $request->getParam('epistemic'),
                'tags' => $tags,
                'category' => $request->getParam('category')
            ],
            'categories' => Category::orderBy('name', 'ASC')->get(),
            'epistemic' => Epistemic::orderBy('title', 'ASC')->get(),
          ],
        ]);

        return $reponse; */
    }
}
