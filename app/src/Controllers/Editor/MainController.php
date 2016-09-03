<?php

namespace App\Controllers\Editor;

use App\Controllers\Controller;

class MainController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'editor/home.twig');
    }

    public function getPosts($request, $response)
    {
        echo 'lol';
    }

    public function getPages($request, $response)
    {
    }

    public function getNewPost($request, $response)
    {
        return $this->view->render($response, 'editor/newpost.twig', [
             'headMeta' => [
                 'title' => 'Create post',
             ],
         ]);
    }

    public function getNewPage($request, $response)
    {
    }
}
