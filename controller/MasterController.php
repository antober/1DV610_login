<?php
    session_start();

    require_once('index.php');

    require_once('controller/LoginController.php');
    require_once('controller/RegisterController.php');
    require_once('controller/PostController.php');
    
    require_once('view/LoginView.php');
    require_once('view/DateTimeView.php');
    require_once('view/LayoutView.php');
    require_once('view/RegisterView.php');
    require_once('view/PostView.php');

    require_once('model/RegisterModel.php');
    require_once('model/LoginModel.php');
    require_once('model/PostModel.php');
    require_once('model/User.php');
    
    require_once('DAL/dbh.php');

    
    class MasterController {
        
        public function initMastercontroller() : void {
            $dbh = new dbh();
            $dtv = new DateTimeView();
            $layv = new LayoutView();
            $lm = new LoginModel($dbh);
            $rm = new RegisterModel($dbh);
            $pm = new PostModel($dbh);
            $pv = new PostView($lm, $dbh);
            
            if(isset($_GET["register"])) {
                $rv = new RegisterView($rm);
                $rc = new RegisterController($rm, $rv);
                $rc->initRegister();
                $layv->render($lm->isLoggedIn(), $rv, $pv, $dtv);
            } else {
                $logv = new LoginView($lm);
                $lc = new LoginController($logv, $lm);
                $pc = new PostController($pv, $pm);
                $lc->initLogin();
                $pc->initPost();
                $pc->initVote();
                $layv->render($lm->isLoggedIn(), $logv, $pv, $dtv);
            }
        }
    }