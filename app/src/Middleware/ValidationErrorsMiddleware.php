<?php

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['form_errors'])) {
            $this->container->view->getEnvironment()->addGlobal('form_errors', $_SESSION['form_errors']);
            unset($_SESSION['form_errors']);
        }

        $response = $next($request, $response);

        return $response;
    }
}
