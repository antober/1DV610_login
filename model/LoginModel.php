<?php
//include_once('Exceptions.php');

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
            throw new UsernameMissing('Username is missing');
        else if($this->password == '')
            throw new PasswordMissing('Password is missing');
        else if(!$this->dbh->getUser($this->username, $this->password))
            throw new WrongCredentials('Wrong name or password');
        else 
            $this->s->setSession($username);
    }

    public function isLoggedIn() : bool {
        return $this->s->getUserSession() !== null;
    }
}