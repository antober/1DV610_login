<?php

class LoginView 
{
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private $message;
	private $lm;

	public function __construct(LoginModel $lm) {
		$this->lm = $lm;
	}

	public function showMessage(string $message) : void {
		$this->message = $message;
	}
	
	public function showWelcomeText() : string {
	 	return 'Welcome';
	}
	
	public function showLogoutText() : string {
		return 'Bye bye!';
	}

	public function response() : string {
		$response = '';

		if ($this->lm->isloggedin()) 
			$response = $this->generateLogoutButtonHTML();
		else
			$response = $this->generateLoginFormHTML();
		
		return $response;
	}

	public function getUsername() : string {
		if(isset($_POST[self::$name]))
			return $_POST[self::$name];		
		else
            return '';
	}

	public function getPassword() : string {
		if(isset($_POST[self::$password]))
			return $_POST[self::$password];
		else
            return '';
	}
	
	public function logoutButton() : bool {
		if(isset($_POST[self::$logout])) 
			return true;
		else
			return false;
	}
	
	public function loginButton() : bool {
		if(isset($_POST[self::$login]))
			return true;
		else
			return false;
	}	

	private function generateLogoutButtonHTML() : string {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $this->message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	private function generateLoginFormHTML() : string {
		if(!$this->lm->isLoggedin())
		return '
			<a href="?register">Register a new user</a>
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getUsername() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
}