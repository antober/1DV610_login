<?php

class RegisterController
{
    public function __construct(RegisterModel $rm, RegisterView $rv)
    {
        $this->rm = $rm;
        $this->rv = $rv;
    }

    public function initRegister()
    {
        if($this->rv->registerPost())
        {
            try
            {
                $this->regUsername = $this->rv->getUserName();
                $this->regPassword = $this->rv->getPassword();
                $this->regReEnterPass = $this->rv->getPasswordRepeat();
            
                $this->rm->tryRegister($this->regUsername, $this->regPassword, $this->regReEnterPass);
            }
            catch(Exception $e)
            {
                $this->rv->statusMessages($e->getMessage());
            }
        }
    }
}