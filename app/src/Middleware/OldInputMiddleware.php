<?php

namespace App\Middleware;

class OldInputMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('old_form_data', $_SESSION['old_form_data']);
        $_SESSION['old_form_data'] = $request->getParams();

        $response = $next($request, $response);

        return $response;
    }
}
