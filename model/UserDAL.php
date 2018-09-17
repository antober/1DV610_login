<?php

class UserDAL
{
    /**
     * $users is suppose to act as a database before its implemented
     * 
     */
    private $username = 'Admin';
    private $password = 'Password';


    /**
     * getUser loops all currently store users
     * @return Void or $user
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}