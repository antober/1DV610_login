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
    require_once('model/Session.php');
    require_once('model/Timestamp.php');
    
    require_once('DAL/dbh.php');
    
    class MasterController {
        
        private static $register = 'register';
        
        public function initMastercontroller() : void {
            $dbh = new dbh();
            $dtv = new DateTimeView();
            $layv = new LayoutView();
            $s = new Session();
            $lm = new LoginModel($dbh, $s);
            $rm = new RegisterModel($dbh);
            $pm = new PostModel($dbh,$s);
            $t = new Timestamp();
            $pv = new PostView($lm, $dbh, $s, $t);
            
            if(isset($_GET[self::$register])) {
                $rv = new RegisterView($rm);
                $rc = new RegisterController($rm, $rv);
                $rc->initRegister();
                $layv->render($lm->isLoggedIn(), $rv, $pv, $dtv);
            } else {
                $logv = new LoginView($lm);
                $lc = new LoginController($logv, $lm, $s);
                $pc = new PostController($pv, $pm);
                $lc->initLogin();
                $pc->initPost();
                $layv->render($lm->isLoggedIn(), $logv, $pv, $dtv);
            }
        }
    }