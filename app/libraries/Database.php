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

    public function __construct()
    {
        $this->pdo = new PDO([
            'database_type' => getenv('DB_DRIVER'),
            'database_name' => getenv('DB_NAME'),
            'server'        => getenv('DB_HOST'),
            'username'      => getenv('DB_USERNAME'),
            'password'      => getenv('DB_PASSWORD')
        ]);
    }
}
