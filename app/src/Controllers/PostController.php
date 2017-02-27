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
	const LINKS = __DIR__ . '/../../../resources/files/links';
	const NOTES = __DIR__ . '/../../../resources/files/notes';

	public function get(Request $request, Response $response, $args)
	{
		$tpl = 'post.twig';
		$cond = [];
		
		if ($request->getAttribute('route')->getName() ===  'post' && $request->getAttribute('route')->getArgument('slug') ===  'Links') {
			return $response->withRedirect($this->container->router->pathFor('page.newsletter'));
		}
		
		if ($request->getAttribute('route')->getName() ===  'link') {
			$file = self::LINKS . '/' . $request->getAttribute('route')->getArgument('year') . '' . $request->getAttribute('route')->getArgument('month') . '.md';
			$tpl = 'links.twig';
			$date = \DateTime::createFromFormat('n-Y', $request->getAttribute('route')->getArgument('month') . '-' . $request->getAttribute('route')->getArgument('year'));
			$cond['date'] = $date->format('Y-m-d');
			$meta['title'] = $date->format('M Y') . ' Links';
		} else {
			$file = self::POSTS . '/' . $request->getAttribute('route')->getArgument('slug') . '.md';
		}
		if (file_exists($file)) {
			$parser = new \Mni\FrontYAML\Parser();
			$post = $parser->parse(file_get_contents($file, FILE_USE_INCLUDE_PATH));
			if ($post === 'Théorèmes') {
				$cond['theorems'] = Post::where('type', 'theorem')->orderBy('created_at', 'DESC')->get();
				$cond['theorems_no'] = count($cond['theorems']);
			}
			if ($request->getAttribute('route')->getArgument('slug') == 'Contact') {
				$tpl = 'contact.twig';
			}
			if (!$this->is_link_post($request)) {
				$meta = $post->getYAML();
			}
			$content = $post->getContent();
			$meta['tags'] = rtrim(implode(', ', $meta['tags'] ?? []), ', ');
			$meta['toc'] = $meta['toc'] ?? false;
			if ($meta['online'] ?? true) {
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
				return $this->container->pagenotfound;
			}
		} else {
			return $this->container->pagenotfound;
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

	protected function is_link_post($req)
	{
		if ($req->getAttribute('route')->getName() ===  'link') {
			return true;
		} else {
			return false;
		}
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
