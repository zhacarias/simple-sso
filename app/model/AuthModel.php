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
    public function loginNonExec(string $username, string $password) : array
    {
        $username = Input::clean($username);
        $password = Input::clean($password);

        $result = $this->pdo->query(
            'SELECT RETURN_CODE, RETURN_VALUE
                    FROM API_CRED_VAL(:username, :password) as result', [
                ':username' => $username,
                ':password' => $password
            ])->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
}
