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
		/* for ($i = (date('Y') - 1); $i <= date('Y'); ++$i) {
		   $posts[$i] = $this->get_by_year($i);
		} */
		$posts = $this->get_content_list('post', 'roll', 10, 'published');

		$last_updated_topics = $this->get_content_list('topic', 'list', 30, 'updated');
		
		$reponse = $this->view->render($response, 'home.twig', [
			'headMeta' => [
				'title' => 'Home',
				'description' => $this->container->webconf['site_description']
		  	],
		  	'data' => [
				'posts' => $posts,
				'intro' => $intro,
				'topics' => $last_updated_topics
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

	protected function get_content_list($type = 'all', $ly = 'roll', $max = 100, $sort_by = 'published')
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
				$meta['layout'] = $meta['layout'] ?? null;
				if ($ly == 'by_year') {
					if (date("Y", $meta['published']) !== strval($year) OR $meta['online'] == false OR $meta['type'] == 'page') {
						unset($posts[$key]);
					}
				}
				if (is_null($post['meta'])) {
					unset($posts[$key]);
				}
				if (in_array($type, ['post', 'topic', 'page', 'experiment', 'link'])) {
					$meta['layout'] = $meta['layout'] ?? null;
					if ($meta['layout'] !== $type) {
						unset($posts[$key]);
					}
				}
			} else {
				return false;
			}
		}

		if ($type == 'topic') {
			uasort($posts, function ($a, $b) {
	        	return ($a['meta']['updated'] > $b['meta']['updated']) ? -1 : 1;
	    	});
		} else {
			uasort($posts, function ($a, $b) {
	        	return ($a['meta']['published'] > $b['meta']['published']) ? -1 : 1;
	    	});
		}

    	array_slice($posts, 0, $max, true);

    	if ($type == 'topic') {
    		$topics = '';
    		foreach ($posts as $topic) {
		        $topics .= '<span class="squares"><span class="'. ($topic['meta']['difficulty'] == 1 ? 'one' : '') . '"><i></i></span></span><a href="./' . $topic['meta']['slug'] . '">' . $topic['meta']['title'] . '</a>, ';
		    }
		    return rtrim($topics, ', ');
    	} else {
    		return $posts;
    	}
	}
}	
