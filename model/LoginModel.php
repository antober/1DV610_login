<?php

class LoginModel
{
    private $username;
    private $passWord;
    private $dbh;

    public function __construct(dbh $dbh)
    {
        $this->dbh = $dbh;
    }

    public function tryLogin(string $username, string $password) : void
    {
        $this->username = $username;
        $this->password = $password;
        
        if($this->username == '')
        {
            throw new Exception('Username is missing');
        }

        else if($this->password == '')
        {
            throw new Exception('Password is missing');
        }
        
        else if($this->username == '' && $this->password == '')
        {
            throw new Exception('Username and Password is missing');
        }

        else if(!$this->dbh->getUser($this->username, $this->password))
        {
            throw new Exception('Wrong name or password');
        }

        else
        {
            $this->setSession($username, $password);
        }
    }

    public function removeSession() : void
    {
        session_destroy();
    }

    public function isLoggedIn() : bool
    {
        return isset($_SESSION['username']) && isset($_SESSION['password']);
    }

    private function setSession(string $username, string $password) : void
    {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    }
}