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

    public function tryLogin($username, $password)    {
        $this->username = $username;
        $this->password = $password;
        
        if($this->username == '')
        {
            throw new Exception('Username is missing');
        }

        if($this->password == '')
        {
            throw new Exception('Password is missing');
        }
        
        else if($this->username == '' && $this->password == '')
        {
            throw new Exception('Username and Password is missing');
        }

        if($this->username == $this->userDAL->getUsername() && $this->password != $this->userDAL->getPassword())
        {
            throw new Exception('Wrong name or password');
        }

        if($this->username != $this->userDAL->getUsername() && $this->password == $this->userDAL->getPassword())
        {
            //TODO: fix bug where welcome is being rendered here
            throw new Exception('Wrong name or password');
        }

        if($this->username == $this->userDAL->getUsername() && $this->password == $this->userDAL->getPassword()) 
        {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        }
    }

    public function removeSession()
    {
        session_destroy();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['username']) && isset($_SESSION['password']);
    }
}