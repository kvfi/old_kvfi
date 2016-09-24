<?php

namespace App\Controllers\Editor;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use App\Models\ProgressionState;
use App\Models\EpistemicState;
use Respect\Validation\Validator as v;

class MainController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'editor/home.twig');
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
            'intro' => v::notEmpty(),
            'category' => v::notEmpty(),
            'progress' => v::notEmpty(),
            'epistemic' => v::notEmpty(),
            'content' => v::notEmpty(),
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
            'content' => $request->getParam('content'),
            'tags' => serialize(explode(', ', $request->getParam('tags'))),
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
            'intro' => v::notEmpty(),
            'category' => v::notEmpty(),
            'progress' => v::notEmpty(),
            'epistemic' => v::notEmpty(),
            'content' => v::notEmpty(),
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
            'content' => $request->getParam('content'),
            'tags' => serialize(explode(', ', $request->getParam('tags'))),
        ]);

        $this->flash->addMessage('info', 'Post');

        return $response->withRedirect($this->router->pathFor(('editor.home')));
    }

    public function getNewPage($request, $response)
    {
        return $this->view->render($response, 'editor/newpage.twig', [
             'headMeta' => [
                 'title' => 'Create page',
             ],
             'data' => [
                 'progressions' => ProgressionState::all(),
                 'epistemics' => EpistemicState::all(),
             ],
         ]);
    }

    public function postNewPage($request, $response)
    {
        if (empty($request->getParam('redirect_to'))) {
            $validation = $this->validator->validate($request, [
                'title' => v::notEmpty(),
                'slug' => v::notEmpty(),
                'intro' => v::notEmpty(),
                'progress' => v::notEmpty(),
                'epistemic' => v::notEmpty(),
                'content' => v::notEmpty()
            ]);
        } else {
            $validation = $this->validator->validate($request, [
                'redirect_to' => v::notEmpty()
            ]);
        }

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('editor.new.page'));
        }

        Page::create([
            'title' => $request->getParam('title'),
            'slug' => $request->getParam('slug'),
            'intro' => $request->getParam('intro'),
            'content' => $request->getParam('content'),
            'progress' => $request->getParam('progress'),
            'epistemic' => $request->getParam('epistemic'),
            'redirect_to' => $request->getParam('redirect_to')
        ]);

        $this->flash->addMessage('info', 'Page'.$request->getParam('title').' was created successfully.');

        return $response->withRedirect($this->router->pathFor('page', ['slug' => $request->getParam('slug')]));
    }

    public function getEditPage($request, $response, $args)
    {
        return $this->view->render($response, 'editor/editpage.twig', [
             'headMeta' => [
                 'title' => 'Edit page: ',
             ],
             'data' => [
                 'page' => Page::where('id', $args['id'])->first(),
                 'categories' => Category::get(['slug', 'name']),
                 'progressions' => ProgressionState::all(),
                 'epistemics' => EpistemicState::all(),
             ],
         ]);
    }

    public function postEditPage($request, $response)
    {
        if (empty($request->getParam('redirect_to'))) {
            $validation = $this->validator->validate($request, [
                'title' => v::notEmpty(),
                'slug' => v::notEmpty(),
                'intro' => v::notEmpty(),
                'progress' => v::notEmpty(),
                'epistemic' => v::notEmpty(),
                'content' => v::notEmpty()
            ]);
        } else {
            $validation = $this->validator->validate($request, [
                'redirect_to' => v::notEmpty()
            ]);
        }

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('editor.edit.page'));
        }

        Page::find($request->getParam('id'))->update([
            'title' => $request->getParam('title'),
            'slug' => $request->getParam('slug'),
            'intro' => $request->getParam('intro'),
            'created_at' => $request->getParam('created_at'),
            'progress' => $request->getParam('progress'),
            'epistemic' => $request->getParam('epistemic'),
            'content' => $request->getParam('content'),
            'redirect_to' => "xd"
        ]);

        $this->flash->addMessage('info', 'Post');

        return $response->withRedirect($this->router->pathFor('page', ['slug' => $request->getParam('slug')]));
    }
}
