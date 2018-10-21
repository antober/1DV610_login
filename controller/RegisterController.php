<?php

class RegisterController
{
    private $rm;
    private $rv;

    public function __construct(RegisterModel $rm, RegisterView $rv)
    {
        $this->rm = $rm;
        $this->rv = $rv;
    }

    public function initRegister() : void
    {
        if($this->rv->registerPost())
        {
            try
            {
                $this->rm->tryRegister($this->rv->getUserName(), 
                $this->rv->getPassword(), $this->rv->getPasswordRepeat());
            }
            catch(Exception $e)
            {
                $this->rv->statusMessages($e->getMessage());
            }
        }
    }
}