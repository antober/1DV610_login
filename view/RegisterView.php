<?php

class RegisterView
{
    private static $messageId = 'registerView::Message';
    private static $register = 'registerView::register';
    private static $regName = 'registerView::regUsername';
    private static $regPassword = 'registerView::regPassword';
    private static $regRePassword = 'registerView::regRePassword';
    private $message;

    public function registerPost()
    {
        if(isset($_POST[self::$register]))
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
        
    public function getRegName()
    {	
        if(isset($_POST[self::$regName]))
        {
            return $_POST[self::$regName];
        }
    }
        
    public function getRegPassword()
    {	
        if(isset($_POST[self::$regPassword]))
        {
            return $_POST[self::$regPassword];
        }
    }
    
    public function getRegRePassword()
    {		
        if(isset($_POST[self::$regRePassword]))
        {
            return $_POST[self::$regRePassword];
        }
    }
    
    public function actionMessages($message)
    {	
        $this->message = $message;
    }
    
    public function response() 
    {
    
        $response = "";
        
        if(isset($_GET["register"]))
        {
            $response = $this->generateRegistrationFormHTML($this->message);
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
                        <p id="' . self::$messageId . '">' . $this->message . '</p>
                        <legend>Register a new user - Write a username and password</legend>
                        
                        <label for="' . self::$regName . '">Username :</label>
                        <input type="text" id="' . self::$regName . '" name="' . self::$regName . '"  /></br>
                        <label for="' . self::$regPassword . '">Password :</label>
                        <input type="password" id="' . self::$regPassword . '" name="' . self::$regPassword . '" /></br>
                        <label for="' . self::$regRePassword . '">Repeat Password :</label>
                        <input type="password" id="' . self::$regRePassword . '" name="' . self::$regRePassword . '" /></br>
                        <input type="submit" name="' . self::$register . '" value="Register" />
                    </fieldset>
            </form>
        ';
		}
}