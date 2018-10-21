<?php

class LoginController
{
    private $lv;
    private $lm;

    public function __construct(LoginView $logv, LoginModel $lm) 
    {   
        $this->lv = $logv;
        $this->lm = $lm;
    }

    public function initLogin() : void
    {
        if(!$this->lm->isLoggedIn())
        { 
            $this->actionLogIn();
        }
        else
        {
            $this->actionLogout();
            $this->lv->showMessage($this->lv->welcomeText());
        }
    }

    private function actionLogIn() : void
    {
        if($this->lv->loginButton())
        {
            try
            {
                $this->lm->tryLogin($this->lv->getUsername(), $this->lv->getPassword());
            }
            catch (exception $e)
            {
                $this->lv->showMessage($e->getMessage());
            }
        }
    }

    //Couldnt solve issue where pressing logout button didnt change layout view
    // to login view at once.
    //Bug: logoutbutton had to be pressed twice to get the proper view.
    //Temp fix: header location
    private function actionLogout() : void
    {
        if($this->lv->logoutButton())
        {
            $this->lm->removeSession();
            $this->lv->showMessage($this->lv->logoutText());
            header('location: https://php-login-app-.herokuapp.com/');
        }
    }
}