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
        }
    }

    private function actionLogIn() : void
    {
        if($this->lv->loginButton())
        {
            try
            {
                $this->lm->tryLogin($this->lv->getUsername(), $this->lv->getPassword());
                //$this->lv->showMessage($this->lv->welcomeText());
            }
            catch (exception $e)
            {
                $this->lv->showMessage($e->getMessage());
            }
        }
    }

    private function actionLogout() : void
    {
        if($this->lv->logoutButton())
        {
            $this->lm->removeSession();
            header('location: https://php-login-app-.herokuapp.com/');
        }
        //$this->lv->showMessage($this->lv->logoutText());
    }
}