<?php

class RegisterView
{
    private static $Message = "RegisterView::Message";
    private static $Register = "registerView::register";
    private static $UserName = "RegisterView::UserName";
    private static $Password = "RegisterView::Password";
    private static $PasswordRepeat = "RegisterView::PasswordRepeat";
    private $message;

    public function __construct(RegisterModel $rm)
    {
        $this->rm = $rm;
    }

    public function registerPost()
    {
        if(isset($_POST[self::$Register]))
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
        
    public function getUserName()
    {	
        if(isset($_POST[self::$UserName]))
        {
            return $_POST[self::$UserName];
        }
    }
        
    public function getPassword()
    {	
        if(isset($_POST[self::$Password]))
        {
            return $_POST[self::$Password];
        }
    }
    
    public function getPasswordRepeat()
    {		
        if(isset($_POST[self::$PasswordRepeat]))
        {
            return $_POST[self::$PasswordRepeat];
        }
    }
    
    public function statusMessages($message)
    {	
        $this->message = $message;
    }
    
    public function response() 
    {
        $response = "";
        
        if(isset($_GET["register"]))
        {
            $response .= $this->generateRegistrationFormHTML($this->message);
        }
        return $response;
    }


    private function generateRegistrationFormHTML() 
    {
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