<?php

namespace App\Model;

use App\Libraries\Database;
use App\Libraries\Input;

/**
 * Class AuthModel
 *
 * @package \App\Model
 */
class AuthModel extends Database
{
    public $username;

    public $password;

    public function auth() : array
    {
        $this->username = Input::clean($this->username);
        $this->password = Input::clean($this->password);

        $result = $this->login();
        $return_code = (int) $result['RETURN_CODE'];

        if ($return_code === 2 || $return_code === 3) {
            $result = $this->loginExec();
            return $result;
        }

        return $result;
    }

    public function login() : array
    {
        $this->connect();
        $result = $this->pdo->query(
            'SELECT RETURN_CODE, RETURN_VALUE
                    FROM API_CRED_VAL(:username, :password) as result', [
                ':username' => $this->username,
                ':password' => $this->password
            ])->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return $this->pdo->error();
        }

        return $result;
    }

    public function loginExec() : array
    {
        $this->connectExec();
        $result = $this->pdo->query(
            'SELECT RETURN_CODE, RETURN_VALUE
                    FROM API_CRED_EXEC_VAL(:username, :password) as result', [
                ':username' => $this->username,
                ':password' => $this->password
        ])->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return $this->pdo->error();
        }
        
        return $result;
    }
}
