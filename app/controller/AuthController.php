<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Model\AuthModel;

/**
 * Class AuthController
 *
 * @package \App\Controller
 */
class AuthController
{
    private $model;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function sso(Request $request, Response $response)
    {
        $username = $request->getServerParam('PHP_AUTH_USER');
        $password = $request->getServerParam('PHP_AUTH_PW');

        if (empty($username) || empty($password)) {
            return $response->withJson(['RETURN_CODE' => 5, 'RETURN_VALUE' => null]);
        }

        $result = $this->model->loginNonExec($username, $password);

        return $response->withJson($result);
    }
}
