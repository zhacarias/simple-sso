<?php

namespace App\Model;

use App\Libraries\ActiveDirectory;
use App\Libraries\Input;
use App\Libraries\Log;

/**
 * Class LdapModel
 *
 * @package \App\Model
 */
class LdapModel extends ActiveDirectory
{
    public $username;

    public $password;

    public $network;

    private $log;

    private $result = [];

    public function __construct()
    {
        $this->log = new Log();
    }

    public function auth(): array
    {
        $this->uid = Input::clean($this->username);
        $this->pwd = Input::clean($this->password);
        $this->org = Input::clean($this->network);
        
        $validate = $this->login();

        if ($validate) {
            return [
                'RETURN_CODE'       => 1,
                'RETURN_VALUE'    => 'Access Granted'
            ];
        }

        return [
            'RETURN_CODE'       => $validate,
            'RETURN_VALUE'    => 'Access Denied',
        ];
    }
}