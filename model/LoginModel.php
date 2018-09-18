<?php

class LoginModel
{
    private $username;
    private $passWord;
    private $message;
    private $check;

    public function __construct($userDAL)
    {
        $this->userDAL = $userDAL;
    }

    /**
     * tryLogin checks if fieldinputs are empty
     * Authenticates user to UserDAL
     * 
     * @throws Exception
     * @return Void
     */

    public function tryLogin($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        
        if($this->username == '' && $this->password == '')
        {
            throw new Exception('Username and Password is missing');
        }

        if($this->username == '')
        {
            throw new Exception('Username is missing');
        }

        if($this->password == '')
        {
            throw new Exception('Password is missing');
        }

        if($this->username == $this->userDAL->getUsername() && $this->password == $this->userDAL->getPassword()) 
        {
            $this->check = true;
        }
        else
        {
            $this->check = false;
        }
    }

    public function tryLogout()
    {
        $this->check = false;
    }

    /**
     * isLoggedIn returns check
     * @return bool
     */
    public function isLoggedIn()
    {
        return $this->check;
    }
}