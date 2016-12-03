<?php

namespace App\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ValidationErrorsMiddleware extends Middleware

{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (isset($_SESSION['form_errors'])) {
            $this->container->view->getEnvironment()->addGlobal('form_errors', $_SESSION['form_errors']);
            unset($_SESSION['form_errors']);
        }

        $response = $next($request, $response);

        return $response;
    }
}
