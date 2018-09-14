<?php

class UserDAL
{
    /**
     * $users is suppose to act as a database before its implemented
     * 
     */
    private $users = [
        'anton' => 'anton', 
        'antoine' => 'antoine', 
        'antonius' => 'antonius'
    ];

    /**
     * getUser loops all currently store users
     * @return Void or $user
     */
    public function getUser($uname)
    {
        foreach ($this->users as $user)
        {
            if ($uname == $user->getUsername())
            {
                return $user;
            }
        }
        return null;
    }
}