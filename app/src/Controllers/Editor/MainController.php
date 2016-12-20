<?php

namespace App\Controllers\Editor;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\ProgressionState;
use App\Models\EpistemicState;
use Respect\Validation\Validator as v;

class MainController extends Controller
{
    public function index($request, $response)
    {
        $posts = Post::where('type', '<>', 'theorem')->orderBy('created_at', 'DESC')->get();

        return $this->view->render($response, 'editor/home.twig', [
            'headMeta' => [

            ],
            'data' => [
                'posts' => $posts,
            ],
        ]);
    }

    public function getNewPost($request, $response)
    {
        return $this->view->render($response, 'editor/newpost.twig', [
             'headMeta' => [
                 'title' => 'Create post',
             ],
             'data' => [
                 'categories' => Category::get(['slug', 'name']),
                 'progressions' => ProgressionState::all(),
                 'epistemics' => EpistemicState::all(),
             ],
         ]);
    }

    public function postNewPost($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'title' => v::notEmpty(),
            'slug' => v::notEmpty(),
            'category' => v::notEmpty(),
            'progress' => v::notEmpty(),
            'epistemic' => v::notEmpty(),
            'difficulty' => v::notEmpty(),
            'type' => v::notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('editor.new.post'));
        }

        Post::create([
            'title' => $request->getParam('title'),
            'slug' => $request->getParam('slug'),
            'intro' => $request->getParam('intro'),
            'category' => $request->getParam('category'),
            'progress' => $request->getParam('progress'),
            'epistemic' => $request->getParam('epistemic'),
            'type' => $request->getParam('type'),
            'tags' => serialize(explode(', ', $request->getParam('tags'))),
            'difficulty' => $request->getParam('difficulty'),
        ]);

        $this->flash->addMessage('info', 'Post');

        return $response->withRedirect($this->router->pathFor(('editor.home')));
    }

    public function getEditPost($request, $response, $args)
    {
        return $this->view->render($response, 'editor/editpost.twig', [
             'headMeta' => [
                 'title' => 'Edit: ',
             ],
             'data' => [
                 'post' => Post::where('id', $args['id'])->first(),
                 'categories' => Category::get(['slug', 'name']),
                 'progressions' => ProgressionState::all(),
                 'epistemics' => EpistemicState::all(),
             ],
         ]);
    }

    public function postEditPost($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'title' => v::notEmpty(),
            'slug' => v::notEmpty(),
            'category' => v::notEmpty(),
            'progress' => v::notEmpty(),
            'epistemic' => v::notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('editor.new.post'));
        }

        Post::find($request->getParam('id'))->update([
            'title' => $request->getParam('title'),
            'slug' => $request->getParam('slug'),
            'intro' => $request->getParam('intro'),
            'created_at' => $request->getParam('created_at'),
            'category' => $request->getParam('category'),
            'progress' => $request->getParam('progress'),
            'epistemic' => $request->getParam('epistemic'),
            'type' => $request->getParam('type'),
            'tags' => serialize(explode(', ', $request->getParam('tags'))),
            'difficulty' => $request->getParam('difficulty'),
        ]);

        $this->flash->addMessage('info', 'Post');

        return $response->withRedirect($this->router->pathFor(('editor.home')));
    }
}
