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

    public function initLogin() : void {
        if(!$this->lm->isLoggedIn()) { 
            $this->userWantsToLogIn();
        } else {
            $this->userWantsToLogout();
        }
    }

    private function userWantsToLogIn() : void {
        if($this->lv->loginButton()) {
            try {
                $this->lm->doActionLogin($this->lv->getUsername(), $this->lv->getPassword());
            } catch (exception $e) {
                $this->lv->showMessage($e->getMessage());
            }
        }
    }

    private function userWantsToLogout() : void {
        if($this->lv->logoutButton())
            $this->s->removeSession();
    }
}