<?php

class LoginController
{
    public function __construct(LoginView $logv, LoginModel $lm) 
    {
        $this->logv = $logv;
        $this->lm = $lm;
    }

    /**
     * initLogin
     * 
     * @return void
     */
    public function initLogin()
    {
        
        if(!$this->lm->isLoggedIn())
        { 
            if($this->logv->post())
            {
                try 
                {
                    $this->lm->tryLogin($this->logv->getUsername(), $this->logv->getPassword());
                    $this->logv->statusMessages($this->logv->welcomeText());          
                }
            
                catch (exception $e)
                {
                    $this->logv->statusMessages($e->getMessage());
                }
            }
        }
        
        if($this->logv->logoutButton() == true)
        {
            // if($this->lm->isLoggedIn())
            // {

            // }
            $this->logv->statusMessages($this->logv->logoutText());
            $this->lm->removeSession();
        } 
    }
}