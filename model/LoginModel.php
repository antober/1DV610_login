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
        var_dump($this->username);
        var_dump($this->password);
        var_dump($this->userDAL->getUsername(), $this->userDAL->getPassword());
        
        if($this->username == '')
        {
            throw new Exception('Username is required!');
        }

        if($this->password == '')
        {
            throw new Exception('Password is required!');
        }
        
        if($this->username && $this->password == '')
        {
            throw new Exception('Username and Password is required!');
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

    public function isLoggedIn()
    {
        return $this->check;
    }
}