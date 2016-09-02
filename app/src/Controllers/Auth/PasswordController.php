<?php

namespace App\Controllers\Auth;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{
    public function getChangePassword(Request $request, Response $response)
    {
        return $this->view->render($response, 'editor/password/change.twig');
    }

    public function postChangePassword(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request, [
            'current_password' => v::noWhiteSpace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => v::noWhiteSpace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('editor.password.change'));
        }

        $this->auth->user()->setPassword($request->getParam('password'));

        $this->flash->addMessage('info', 'Password changed');

        return $response->withRedirect($this->router->pathFor(('editor.home')));
    }
}
