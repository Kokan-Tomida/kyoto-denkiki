<?php 
	require_once dirname(__FILE__) . "/../../common/system/application.php";
$lang = 0;
$hassocial = 1;
    require_once(dirname(__FILE__)."/system/lib.php"); 
    require_once(dirname(__FILE__)."/system/ctl.php"); 
    $ctl = new Controller();
    $ctl->action();
?>