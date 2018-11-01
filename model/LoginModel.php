<?php

class LoginModel {
    private $username;
    private $passWord;
    private $dbh;
    private $s;

    public function __construct(dbh $dbh, Session $s) {
        $this->dbh = $dbh;
        $this->s = $s;
    }

    public function tryActionLogin(string $username, string $password) : void {
        $this->username = $username;
        $this->password = $password;
        
        if($this->username == '')
            throw new Exception('Username is missing');
        else if($this->password == '')
            throw new Exception('Password is missing');
        else if($this->username == '' && $this->password == '')
            throw new Exception('Username and Password is missing');
        else if(!$this->dbh->getUser($this->username, $this->password))
            throw new Exception('Wrong name or password');
        else 
            $this->s->setSession($username, $password);
    }

    public function isLoggedIn() : bool {
        return isset($_SESSION['username']) && isset($_SESSION['password']);
    }

    
}