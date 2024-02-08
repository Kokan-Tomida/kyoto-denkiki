<?php

	require_once('./include/env/env.inc');

	require_once(PATH_MODULES.'/const/constant.inc');

	$v = (G_SYS_TEST === true ) ? '0' : '1';
	ini_set('display_errors', $v );
	ini_set('display_startup_errors',$v);
	if($v == '1')    error_reporting(E_ALL);
	
	require_once(PATH_MODULES.'/class/base.class.php');
	
	require_once(PATH_LIB.'/SystemInfo.class.php');
	require_once(PATH_LIB.'/Template.class.php');

	require_once(PATH_LIB.'/MyDBAccess.class.php');
	require_once(PATH_LIB.'/Files.class.php');

  	require_once(PATH_LIB.'/Common.class.php');
	require_once(PATH_LIB.'/Validate.class.php');
	require_once(PATH_LIB.'/CSVCreate.class.php');
	require_once(PATH_MODULES.'/class/member.php');

	header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);

	header('Pragma: no-cache');
	header('Content-Type: text/html; charset=UTF-8');
	mb_internal_encoding('UTF-8');
	mb_language('ja');
	mb_http_output('UTF-8');
	date_default_timezone_set('Asia/Tokyo');
	
	mb_detect_order(array('UTF-8', 'EUC-JP', 'Shift-JIS'));
 
	//session_set_cookie_params(3600); // second 60*60
	session_start();
	session_cache_limiter('private, must-revalidate');

/*
	$date_today = mktime (0, 0, 0, date('m'), date('d'),  date('y'));
	$date_tomorrow = $date_today + 86400;
	date(DATE_RFC1123, $date_tomorrow);

	header('Cache-Control: max-age=' . ($date_tomorrow - time()));
	if (session_id()) {
  		header('Expires: ' . date(DATE_RFC1123, $date_tomorrow));
  		header('Pragma: cache');
	}
*/

	$external = array();
	
	if(aexists('SCRIPT_FILENAME', $_SERVER)){
		$info = pathinfo($_SERVER['SCRIPT_FILENAME']);
		if($info['filename'] != 'index'){
			if(!aexists2(S_KEY11, S_KEY99, $_SESSION)){
				session_unset();
				header("location: ".THIS_ROOT_URL.DS."index.php");
				exit;
			}else{
				if(aexists('admin_id',$_SESSION[S_KEY11][S_KEY99])){
					if((axts('admin_id',$_SESSION[S_KEY11][S_KEY99]) == '')
						or (axts('admin_pass',$_SESSION[S_KEY11][S_KEY99] == "" ) )){
							session_unset();
							header("location: ".THIS_ROOT_URL.DS."index.php");
							exit;
						}
				}	
			}
		}
	}

?>
