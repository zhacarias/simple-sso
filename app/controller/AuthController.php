<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Model\AuthModel;
use App\Model\LdapModel;
use App\Libraries\Log;

/**
 * Class AuthController
 *
 * @package \App\Controller
 */
class AuthController
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

        $this->model = new AuthModel();
        $this->model->username = $username;
        $this->model->password = $password;
        $result = $this->model->auth();

        $attribute = [
            'CODE' => $result['RETURN_CODE'],
            'VALUE' => $result['RETURN_VALUE'],
            'IP' => $ip_origin,
            'METHOD' => $method,
            'START' => $time_start_full
        ];

        $this->log->authLog($username, $attribute, $time_start);

        return $response->withJson($result);
    }

    public function ldap(Request $request, Response $response)
    {
        $time_start_full = date("h:i:s a");
        $time_start = microtime();
        $ip_origin = $_SERVER['REMOTE_ADDR'];
        $method = $request->getMethod();

        $param  = $request->getQueryParams();
        $username = $request->getServerParam('PHP_AUTH_USER');
        $password = $request->getServerParam('PHP_AUTH_PW');
        $network = $param['network'];

        if (empty($username) || empty($password) || empty($network)) {
            return $response->withJson(['RETURN_CODE' => 2, 'RETURN_VALUE' => 'Missing required parameters']);
        }

        $this->model = new LdapModel();
        $this->model->username = $username;
        $this->model->password = $password;
        $this->model->network  = $network;
        $result = $this->model->auth();

        $attribute = [
            'CODE' => $result['RETURN_CODE'],
            'VALUE' => $username,
            'IP' => $ip_origin,
            'METHOD' => $method,
            'START' => $time_start_full
        ];

        $this->log->ldapLog($username, $attribute, $time_start);
        
        return $response->withJson($result);
    }
}
