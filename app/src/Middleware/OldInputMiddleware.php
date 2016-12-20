<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OldInputMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (isset($_SESSION['old_form_data'])) {
            $this->container->view->getEnvironment()->addGlobal('old_form_data', $_SESSION['old_form_data']);
            $_SESSION['old_form_data'] = $request->getParams();
        }

        $response = $next($request, $response);

        return $response;
    }
}
