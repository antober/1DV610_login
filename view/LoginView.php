<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private $message;

	public function __construct(LoginModel $lm) 
	{
		$this->lm = $lm;
	}

	/**
	 * Sets message
	 * 
	 * @return void
	 */
	public function statusMessages ($message) 
	{
		$this->message = $message;
	}
	
	/**
	 * sets message to welcome
	 * 
	 * @return void
	 */
	public function welcomeText()
	{
	 	return 'Welcome';
	}
	
	/**
	 * Sets message to Bye bye
	 * 
	 * @return void
	 */
	public function byebyeText()
	{
		return 'Bye bye';
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		
		$message = ''; 
		$response = '';
	
		if ($this->lm->isloggedin())
		{
			$response .= $this->generateLogoutButtonHTML($this->message);
		}
		else 
		{
			 $response .= $this->generateLoginFormHTML($this->message);
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	public function getUsername()
	{
		return $_POST[self::$name];		
	}

	public function getPassword()
	{
		return $_POST[self::$password];
	}
	
	/**
	 * Listens to logoutButton
	 * 
	 * @return bool
	 */
	public function logoutButton()
	{
		if(isset($_POST[self::$logout])) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	/**
	 * Listens to loginbutton
	 * 
	 * @return bool
	 */
	public function post()
	{
		if(isset($_POST[self::$login]))
		{ 
			return true;
		}
		else 
		{
			return false;
		}
	}	
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}
}