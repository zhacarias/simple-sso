<?php

namespace App\Libraries;

use Zend\Ldap\Ldap;
use Zend\Ldap\Exception\LdapException;

/**
 * Class ActiveDirectory
 *
 * @package \App\Libraries
 */
class ActiveDirectory
{
    private $ldap;

    protected $org;

    protected $uid;

    protected $pwd;

    private $options = [];

    protected function startSession()
    {
        switch ($this->org) {
            case 'SMRI':
                    $this->options = [
                        'host'              => getenv('SMRI_LDAP_HOST'),
                        'accountDomainName' => getenv('SMRI_LDAP_DOMAIN'),
                        'baseDn'            => getenv('SMRI_LDAP_DN')
                    ];
                break;
            case 'SMRINC':
                    $this->options = [
                        'host'              => getenv('SMRINC_LDAP_HOST'),
                        'accountDomainName' => getenv('SMRINC_LDAP_DOMAIN'),
                        'baseDn'            => getenv('SMRINC_LDAP_DN')
                    ];
                break;
            case 'SMIC':
                    $this->options = [
                        'host'              => getenv('SMIC_LDAP_HOST'),
                        'accountDomainName' => getenv('SMIC_LDAP_DOMAIN'),
                        'baseDn'            => getenv('SMIC_LDAP_DN')
                    ];
                break;
        }

        $this->ldap = new Ldap($this->options);
    }

    protected function login()
    {
        $this->startSession();

        try {
            $this->ldap->bind($this->uid, $this->pwd);

            return true;
        } catch (LdapException $ex) {
            return false;
        }
    }
}