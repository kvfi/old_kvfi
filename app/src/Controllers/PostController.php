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
        $cond = [];

        if (!$post) {
            return $this->pagenotfound;
        }

        if ($post->slug === 'Théorème du jour')
        {
            $cond['theorems'] = Post::where('type', 'theorem')->get();
        }

        return $this->view->render($response, 'post.twig', array(
            'headMeta' => [
                'title' => $post->title,
                'description' => $post->intro,
            ],
            'data' => array(
                'post' => $post,
                'category' => Category::where('slug', $post->category)->first(),
                'content' => $this->getPostContent($post->slug),
                'tags' => $this->getFormattedPostTags($post->slug),
                'cond' => $cond
                /* 'comments' => $post->comments(),
                'comment_count' => count($post->comments()), */
            ),
        ));
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

    protected function getFormattedPostTags($slug)
    {
        $tags = Post::select('tags')->where('slug', $slug)->first();
        $tags = unserialize($tags->tags);
        $taglist = "";
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                $taglist .= '<a href="'.$this->container->router->pathFor('archives').'?tag='.$tag.'">'.$tag . '</a>, '; 
            }
        }
        return rtrim($taglist, ", ");
    }
}
