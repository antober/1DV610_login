<?php

class LoginModel
{
    private $username;
    private $passWord;
    private $message;
    private $check;

    /**
     * tryLogin checks if fieldinputs are empty
     * Authenticates user to UserDAL
     * @throws Exception
     * @return Void
     */

    public function tryLogin($username, $passWord)
    {
        $this->username = userName;
        $this->password = password;

        
        if($this->userName == '')
        {
            throw new Exception('Username is required!');
        }

        if($this->password == '')
        {
            throw new Exception('Password is required!');
        }
        
        else if($this->username and $this->password == '')
        {
            throw new Exception('Username and Password is required!');
        }
        
        $user = $this->userDAL->getUser($this->username);

        if($user != null && $user->getPassword() == $this->password) 
        {
            $this->check = true;
        }
        else 
        {
            $this->check = false;
            throw new Exception('Wrong name or password!');
        }
    }
}

?>