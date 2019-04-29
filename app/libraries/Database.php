<?php

namespace App\Libraries;

use Medoo\Medoo as PDO;

/**
 * Class Database
 *
 * @package \App\Libraries
 */
class Database
{
    protected $pdo;

    protected function connect()
    {
        $this->pdo = new PDO([
            'database_type' => getenv('DB_DRIVER'),
            'database_name' => getenv('DB_NAME'),
            'server'        => getenv('DB_HOST'),
            'username'      => getenv('DB_USERNAME'),
            'password'      => getenv('DB_PASSWORD')
        ]);
    }

    protected function connectExec()
    {
        $this->pdo = new PDO([
            'database_type' => getenv('DB_DRIVER_EXEC'),
            'database_name' => getenv('DB_NAME_EXEC'),
            'server'        => getenv('DB_HOST_EXEC'),
            'username'      => getenv('DB_USERNAME_EXEC'),
            'password'      => getenv('DB_PASSWORD_EXEC')
        ]);
    }
}
