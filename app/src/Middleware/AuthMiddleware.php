<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AuthMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (!$this->container->auth->check()) {
            $this->container->flash->addMessage('error', 'XD WHATERVER M8.');

            return $response->withRedirect($this->container->router->pathFor('editor.login'));
        }

        $response = $next($request, $response);

        return $response;
    }
}
