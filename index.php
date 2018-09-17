<?php
    /**
     * This is the starting point of the Login application
     * 
     * @author Anton Öberg
     * @version 1.0
     */
    
     require_once('controller/MasterController.php');
    
    // //MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    
    /**
     * Instanciates a new MasterController
     * 
     * Launches Login application
     */
    $mc = new MasterController();
    $mc->LaunchApplication();

?>

