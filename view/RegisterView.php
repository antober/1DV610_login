<?php

class RegisterView {
    private static $Message = "RegisterView::Message";
    private static $Register = "RegisterView::Register";
    private static $UserName = "RegisterView::UserName";
    private static $Password = "RegisterView::Password";
    private static $PasswordRepeat = "RegisterView::PasswordRepeat";
    private $message;
    private $rm;

    public function __construct(RegisterModel $rm) {
        $this->rm = $rm;
    }

    public function registerPost() : bool {
        if(isset($_POST[self::$Register]))
            return true;
        else 
            return false;
    }
        
    public function getUserName() : string {	
        if(isset($_POST[self::$UserName]))
            return $_POST[self::$UserName];
        else
            return '';
    }
        
    public function getPassword() : string {	
        if(isset($_POST[self::$Password]))
            return $_POST[self::$Password];
        else
            return '';
    }
    
    public function getPasswordRepeat() : string {		
        if(isset($_POST[self::$PasswordRepeat]))
            return $_POST[self::$PasswordRepeat];
        else
            return '';
    }
    
    public function statusMessages(string $message) : void {	
        $this->message = $message;
    }
    
    public function response() : string
    {
        $response = '';
        
        if(isset($_GET["register"]))
            $response = $this->generateRegistrationFormHTML();
        
        return $response;
    }


    private function generateRegistrationFormHTML() : string {
        return 
        '
            <a href="?login">Back to login</a>
            <form method="post" >
                    <fieldset>
                        <p id="' . self::$Message . '">' . $this->message . '</p>
                        <legend>Register a new user - Write a username and password</legend>
                        
                        <label for="' . self::$UserName . '">Username :</label>
                        <input type="text" id="' . self::$UserName . '" name="' . self::$UserName . '" value="' .$this->getUserName() . '"  />
                        <label for="' . self::$Password . '">Password :</label>
                        <input type="password" id="' . self::$Password . '" name="' . self::$Password . '" />
                        <label for="' . self::$PasswordRepeat . '">Repeat Password :</label>
                        <input type="password" id="' . self::$PasswordRepeat . '" name="' . self::$PasswordRepeat . '" />
                        <input type="submit" name="' . self::$Register . '" value="Register" />
                    </fieldset>
            </form>
        ';
	}
}