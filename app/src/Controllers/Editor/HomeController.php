<?php

namespace App\Controllers\Editor;

use App\Controllers\Controller;

class HomeController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'editor/home.twig');
    }
}
