<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Factory;

/**
 * @property $this backend
 * @property $this frontend
 */
class AuthenticateService
{

    /**
     * Authenticate instance
     */
    private $authInstance;

    private $mode;

    public function __construct(Factory $authInstance)
    {
        $this->authInstance = $authInstance;
    }

    public function __get($name)
    {
        if($name == 'frontend')
        {
            $this->mode = 'web';
        }
        else if($name == 'backend')
        {
            $this->mode = 'backend';
        }
        else
        {
            throw new \Exception('Property not found on \App\Services\AuthenticateService');
        }

        $this->authInstance = $this->authInstance->guard($this->mode);
        return $this;
    }

    /**
     * Login
     * @param $username
     * @param $password
     * @return bool true if successful to login, false if not
     */
    public function login($username, $password)
    {
        if($this->mode == 'backend')
        {
            return $this->authInstance->attempt(['username' => $username, 'password' => $password, 'type' => 'STAFF']);
        }
        else
        {
            return $this->authInstance->attempt(['username' => $username, 'password' => $password, 'type' => 'APPLICANT']);
        }
    }

    /**
     * Logout
     * @return bool true if successful, false if not login or fail to logout
     */
    public function logout()
    {
        if($this->authInstance->check()) {
            $this->authInstance->logout();
            return True;
        }

        return False;
    }

}