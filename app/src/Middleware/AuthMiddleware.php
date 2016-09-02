<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (!$this->container->auth->check()) {
            $this->container->flash->addMessage('error', 'XD WHATERVER M8.');

            return $response->withRedirect($this->container->router->pathFor('editor.login'));
        }

        $response = $next($request, $response);

        return $response;
    }
}
