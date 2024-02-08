<?php

//	require_once('./include/env/env.inc');
    error_reporting(E_ALL & ~E_NOTICE);

	require_once(PATH_MODULES.'/const/constant.inc');

	require_once(PATH_MAIL_TEMPLATE.DS.'mail_constant.inc');

	$v = (G_SYS_TEST === true ) ? '0' : '1';

	ini_set('display_errors', $v );
	ini_set('display_startup_errors',$v);
	if($v != '1'){
		ini_set('display_errors', 'Off' );
		ini_set('display_startup_errors','Off');
	}

	require_once(PATH_MODULES.'/class/base.class.php');

	require_once(PATH_LIB.'/SystemInfo.class.php');
	require_once(PATH_LIB.'/Template.class.php');

	require_once(PATH_LIB.'/MyDBAccess.class.php');
	require_once(PATH_LIB.'/Files.class.php');
	require_once(PATH_LIB.'/MemberMail.class.php');

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

    error_reporting(E_ALL & ~E_NOTICE);

	//session_set_cookie_params(3600); // second 60*60
	session_start();
	session_cache_limiter('private, must-revalidate');

	$external = array();

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


	/* https
	*	THIS_ROOT_URL_CONTACT     domain/contact
	* 	THIS_ROOT_URL_MEMBER      domain/member
	*	THIS_ROOT_URL_OPT         domain/opt download除く
	* 	THIS_ROOT_URL_POWER       domain/power download除く
	* 	THIS_ROOT_URL_OPT_SAMPLE  domain/opt/sample
	*   ex
	* 'SCRIPT_URL' => '/opt_test/products/fluorescent/fp/index.php',
	* 'SCRIPT_URI' => 'https://www.kdn.co.jp/products/opt_test/products/fluorescent/fp/index.php',
	* 'HTTPS' => 'on'
  	**/

	/*$dir_https = array(
		DOMAIN.SUBDIR_CONTACT 							=> THIS_ROOT_URL_CONTACT,
		DOMAIN.SUBDIR_MEMBER 							=> THIS_ROOT_URL_MEMBER,
		DOMAIN.SUBDIR_OPT_SAMPLE 						=> THIS_ROOT_URL_OPT_SAMPLE,
		//DOMAIN.SUBDIR_OPT_DOWNLOAD.DS.'index.php' 		=> THIS_ROOT_URL_OPT_DOWNLOAD.DS.'index.php',
		//DOMAIN.SUBDIR_OPT_DOWNLOAD.DS.'download_list.php' 		=> THIS_ROOT_URL_OPT_DOWNLOAD.DS.'download_list.php',
		//DOMAIN.SUBDIR_POWER_DOWNLOAD.DS.'index.php' 	=> THIS_ROOT_URL_POWER_DOWNLOAD.DS.'index.php',
		//DOMAIN.SUBDIR_POWER_DOWNLOAD.DS.'download_list.php' 	=> THIS_ROOT_URL_POWER_DOWNLOAD.DS.'download_list.php',
		DOMAIN.SUBDIR_OPT_DOWNLOAD 		=> THIS_ROOT_URL_OPT_DOWNLOAD,
		DOMAIN.SUBDIR_POWER_DOWNLOAD 	=> THIS_ROOT_URL_POWER_DOWNLOAD,
	);
_log(var_export($dir_https,1));

	$dm_dir = array(
		DOMAIN.SUBDIR_CONTACT,
		DOMAIN.SUBDIR_MEMBER,
		DOMAIN.SUBDIR_OPT_SAMPLE,
		DOMAIN.SUBDIR_OPT_DOWNLOAD,
		DOMAIN.SUBDIR_POWER_DOWNLOAD,
		DOMAIN.SUBDIR_OPT_DOWNLOAD.DS.'index.php',
		DOMAIN.SUBDIR_POWER_DOWNLOAD.DS.'index.php'
	);

	//if((IS_HTTPS == true) and (axts('HTTPS',$_SERVER) == 'on')){
	if(IS_HTTPS == true){
		// https request
		$script_uri = axts('SCRIPT_URI',$_SERVER);
		$request_uri = axts('REQUEST_URI',$_SERVER);
		foreach($dir_https as $dm => $jump){
			if($script_uri== '')	continue;
			$res = strpos($script_uri,$dm);
			if($res === false)	continue;
			if(strpos($script_uri,HTTPS) !== false)	break;
			if(in_array($dm,$dm_dir)){
				$f = basename($request_uri);
				// if(strpos('.',$f)){
				$header = ($f != '') ? $jump.DS.$f : $jump;
				// }else{
				// $header = ($f != '') ? $jump : $jump;
				// }
				header('location: '.$header);
				exit;
			}else{
				header('location: '.$jump);
				exit;
			}
		}
	}*/
?>
