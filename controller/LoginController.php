<?php

class LoginController {
    private $lv;
    private $lm;
    private $s;

    public function __construct(LoginView $logv, LoginModel $lm, Session $s) {   
        $this->lv = $logv;
        $this->lm = $lm;
        $this->s = $s;
    }

    public function initLogin() : void
    {
        if(!$this->lm->isLoggedIn()) { 
            $this->doActionLogIn();
        } else {
            $this->doActionLogout();
        }
    }

    private function doActionLogIn() : void {
        if($this->lv->loginButton()) {
            try {
                $this->lm->tryActionLogin($this->lv->getUsername(), $this->lv->getPassword());
                $this->lv->showMessage($this->lv->showWelcomeText());
            } catch (exception $e) {
                $this->lv->showMessage($e->getMessage());
            }
        }
    }

    private function doActionLogout() : void {
        if($this->lv->logoutButton())
            $this->s->removeSession();
            //$this->lv->showMessage($this->lv->showLogoutText());
    }
}