<?php

class Session {

    public function setSession(string $username, string $password) : void {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    }

    public function removeSession() : void {
        session_destroy();
    }
}