<?php

namespace App\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GuestMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if ($this->container->auth->check()) {
            return $response->withRedirect($this->container->router->pathFor('editor.home'));
        }

        $response = $next($request, $response);

        return $response;
    }
}
