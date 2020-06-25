<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Model\AuthModelV2;
use App\Libraries\Log;

/**
 * Class AuthController
 *
 * @package \App\Controller
 */
class AuthControllerV2
{
    private $model;

    private $log;

    public function __construct()
    {
        $this->log = new Log();
    }

    public function sso(Request $request, Response $response)
    {
        $time_start_full = date("h:i:s a");
        $time_start = microtime();
        $ip_origin = $_SERVER['REMOTE_ADDR'];
        $method = $request->getMethod();

        $username = $request->getServerParam('PHP_AUTH_USER');
        $password = $request->getServerParam('PHP_AUTH_PW');

        if (empty($username) || empty($password)) {
            return $response->withJson(['RETURN_CODE' => 5, 'RETURN_VALUE' => null]);
        } 

        $this->model = new AuthModelV2();
        $this->model->username = $username;
        $this->model->password = $password;
        $result = $this->model->auth();

        $attribute = [
            'V2 CODE' => $result['RETURN_CODE'],
            'VALUE' => $result['RETURN_VALUE'],
            'IP' => $ip_origin,
            'METHOD' => $method,
            'START' => $time_start_full
        ];

        $this->log->authLog($username, $attribute, $time_start);

        return $response->withJson($result);
    }
}
