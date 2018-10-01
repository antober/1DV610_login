<?php
    session_start();

    require_once('index.php');

    require_once('controller/LoginController.php');
    require_once('controller/RegisterController.php');
    
    require_once('view/LoginView.php');
    require_once('view/DateTimeView.php');
    require_once('view/LayoutView.php');
    require_once('view/RegisterView.php');

    require_once('model/RegisterModel.php');
    require_once('model/LoginModel.php');
    
    require_once("DAL/UserDAL.php");
    require_once("DAL/User.php");
    
    class MasterController 
    {
        /**
         * LaunchApplication instansiates necessary components 
         * 
         * @return void
         */

        public function initMastercontroller()
        {
            $uDAL = new UserDAL();
            $dtv = new DateTimeView();
            $layv = new LayoutView();
            $lm = new LoginModel($uDAL);
            $rm = new RegisterModel($uDAL);
            
            
            if(isset($_GET["register"]))
            {
                $rv = new RegisterView($rm);
                $rc = new RegisterController($rm, $rv);
                $rc->initRegister();
                $layv->render($lm->isLoggedIn(), $rv, $dtv);
            }

            else
            {
                $logv = new LoginView($lm);
                $lc = new LoginController($logv, $lm);
                $lc->initLogin();
                $layv->render($lm->isLoggedIn(), $logv, $dtv);
            }
        }
    }