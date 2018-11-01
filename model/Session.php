<?php

class Session {
    private static $username = 'username';
    private static $password = 'password';

    public function setSession(string $username, string $password) : void {
        $_SESSION[self::$username] = $username;
        $_SESSION[self::$password] = $password;
    }

    public function removeSession() : void {
        session_destroy();
    }
}