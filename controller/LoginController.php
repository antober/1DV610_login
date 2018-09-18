<?php

class LoginController
{
    public function __construct(LoginView $logv, LoginModel $lm) 
    {
        $this->logv = $logv;
        $this->lm = $lm;
    }

    /**
     * initializeLogin
     * @return void
     */
    public function initializeLogin()  
    {
        
        if(!$this->lm->isLoggedIn())
        { 
            if ($this->logv->post())
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
        else 
        {
            if($this->logv->logoutButton() == true)
            {
                $this->lm->tryLogout();
                var_dump($this->lm->tryLogout());
                $this->logv->byebyeText();
            }
        }
    }
}