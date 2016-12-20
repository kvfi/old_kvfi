<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CsrfViewMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden" name="'.$this->container->csrf->getTokenNameKey().'" value="'.$this->container->csrf->getTokenName().'" />
                <input type="hidden" name="'.$this->container->csrf->getTokenValueKey().'" value="'.$this->container->csrf->getTokenValue().'" />
            ',
        ]);
        $_SESSION['old_form_data'] = $request->getParams();

        $response = $next($request, $response);

        return $response;
    }
}
