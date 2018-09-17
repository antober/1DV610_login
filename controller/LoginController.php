<?php

class LoginController
{
    public function __construct(LoginView $logv, LoginModel $lm) 
    {
        $this->logv = $logv;
        $this->lm = $lm;
    }

    public function initializeLogin()  
    {
        
        if(!$this->lm->isLoggedIn())
        { 
            if ($this->logv->post())
            {
                try 
                {
                    var_dump($this->logv->getUsername());
                    var_dump($this->logv->getPassword());
                    $this->lm->tryLogin($this->logv->getUsername(), $this->logv->getPassword());
                    $this->logv->welcomeText();              
                }
            
                catch (exception $e)
                {
                    $this->logv->statusMessages($e->getMessage());
                }
            }
        }
        else 
        {
            if($this->logv->logoutButton() == true)
            {
                $this->lm->tryLogout();
                $this->logv->byebyeText();
            }
        }
    }
}