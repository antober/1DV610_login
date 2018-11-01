<?php

class LoginController {
    private $lv;
    private $lm;

    public function __construct(LoginView $logv, LoginModel $lm) {   
        $this->lv = $logv;
        $this->lm = $lm;
    }

    public function initLogin() : void
    {
        if(!$this->lm->isLoggedIn()) { 
            $this->doActionLogIn();
        } else {
            $this->doActionLogout();
            $this->lv->showMessage($this->lv->showWelcomeText());
        }
    }

    private function doActionLogIn() : void {
        if($this->lv->loginButton()) {
            try {
                $this->lm->tryActionLogin($this->lv->getUsername(), $this->lv->getPassword());
            } catch (exception $e) {
                $this->lv->showMessage($e->getMessage());
            }
        }
    }

    private function doActionLogout() : void {
        if($this->lv->logoutButton())
            $this->lm->removeSession();
            $this->lv->showMessage($this->lv->showLogoutText());
            //header('location: http://localhost:8888/1DV610_login/');
            //header('location: https://php-login-app-.herokuapp.com/');
    }
}