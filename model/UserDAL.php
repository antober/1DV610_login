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
     * getUser gets username field
     * @return username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * getPassword gets password field
     * @return password
     */
    public function getPassword()
    {
        return $this->password;
    }
}