<?php
    session_start();

    require_once('index.php');
    require_once('model/UserDAL.php');
    require_once('view/LoginView.php');
    require_once('view/DateTimeView.php');
    require_once('view/LayoutView.php');
    require_once('controller/LoginController.php');
    require_once('controller/RegisterController.php');
    require_once('model/LoginModel.php');
    
    class MasterController 
    {
        
        /**
         * LaunchApplication instansiates necessary components 
         * 
         * @return void
         */

        public function LaunchApplication()
        {
            $uDAL = new UserDAL();
            $dtv = new DateTimeView();
            $layv = new LayoutView();
            $lm = new LoginModel($uDAL);
            $logv = new LoginView($lm);
            $lc = new LoginController($logv, $lm);

            $lc->initializeLogin();
            $layv->render($lm->isLoggedIn(), $logv, $dtv);
        }
    }