<?php

class RegisterController
{
    private $regm;
    private $regv;

    public function __contruct(RegisterModel $rm, RegisterView $rv)
    {
        $this->rm = $regm;
        $this->rv = $regv;
    }

    public function initRegister()
    {
        if($this->regv->registerPost())
		{
			try
			{
				$this->regUsername = $this->regView->getRegName();
				$this->regPassword = $this->regView->getRegPassword();
				$this->regReEnterPass = $this->regView->getRegRePassword();
			
				$this->regModel->tryRegister($this->regUsername, $this->regPassword, $this->regReEnterPass);
			}
			catch(Exception $e)
			{
				$this->regView->actionMessages($e->getMessage());
			}
		}
    }
}