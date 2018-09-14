<?php

    require_once('index.php');
    require_once('view/LoginView.php');
    require_once('view/DateTimeView.php');
    require_once('view/LayoutView.php');
    require_once('controller/LoginController.php');
    require_once('controller/RegisterController.php');
    require_once('model/LoginModel.php');
    
    class MasterController 
    {
        /**
         * 
         * LaunchApplication instansiates necessary components 
         * 
         * @return void
         */

        public function LaunchApplication()
        {
            $logv = new LoginView();
            $dtv = new DateTimeView();
            $layv = new LayoutView();
            
            $layv->render(false, $v, $dtv);
            
            //TODO: instansiate relevent objects 
            //and run relevant methods for this login eventlistener
            if(isset($_GET['login']))
            {
                $lm = new LoginModel();
                
            }      
        }
    } 
?>