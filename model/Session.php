<?php

class Session {

    private static $username = 'username';
    
    public function setUserSession(string $username) : void {
        $_SESSION[self::$username] = $username;
    }

    public function removeSession() : void {
        session_destroy();
    }

    public function getUserSession() {
        if(isset($_SESSION[self::$username]))
            return $_SESSION[self::$username];
    }
}